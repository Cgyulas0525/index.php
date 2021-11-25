<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateszamlaRequest;
use App\Http\Requests\UpdateszamlaRequest;
use App\Repositories\szamlaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;
use App\Models\Szamla;
use App\Models\Partner;

class szamlaController extends AppBaseController
{
    /** @var  szamlaRepository */
    private $szamlaRepository;

    public function __construct(szamlaRepository $szamlaRepo)
    {
        $this->szamlaRepository = $szamlaRepo;
    }

    private function dataView($data) {
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                $btn = '<a href="' . route('szamlas.edit', [$row->id]) . '"
                                     class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                $btn = $btn.'<a href="' . route('SzamlaTorles', [$row->id]) . '"
                                     class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                $btn = $btn.'<a href="' . route('szamlaFeldolgozas', [$row->id]) . '"
                                  class="btn btn-warning btn-sm szamlaFeldolgozas" title="Feldolgozás"><i class="glyphicon glyphicon-share"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function mindenAdat()
    {
        return DB::table('szamla')
            ->join('partner', 'partner.id', '=', 'szamla.partner')
            ->join('dictionaries', 'dictionaries.id', '=', 'szamla.fizitesimod')
            ->leftJoin('mozgasfej', 'mozgasfej.id', '=', 'szamla.mozgasfej_id')
            ->select('szamla.*', 'partner.nev as pnev', 'dictionaries.nev as fiznev', 'mozgasfej.bizszam as bizonylatszam',
                DB::raw('(SELECT COUNT(*) FROM szamlatetel WHERE szamlatetel.szamla = szamla.id AND szamlatetel.deleted_at is null) as tetelszam'))
            ->whereNull('szamla.deleted_at')
            ->get();
    }

    /**
     * Display a listing of the szamla.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

          if ($request->ajax()) {

              $kezdo = date('Y-m-d', strtotime('today -30 day'));
              $veg   = date('Y-m-d', strtotime('today'));

              return $this->dataView($this->mindenAdat()->whereBetween('kelt', [$kezdo, $veg]));
          }

          return view('szamlas.index');

         }
         return view('auth.login');
    }

    /**
     * Display a listing of the szamla.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexFeldolgozott(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

               return $this->dataView($this->mindenAdat()->where('feldolgozott', 0));

            }

            return view('szamlas.index');

        }
        return view('auth.login');
    }

    /**
     * Display a listing of the szamla.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexIdei(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $kezdo = date('Y-m-d', strtotime('first day of january this year'));
                $veg   = date('Y-m-d', strtotime('last day of december this year'));
                return $this->dataView($this->mindenAdat()->whereBetween('kelt', [$kezdo, $veg]));

            }

            return view('szamlas.index');

        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new szamla.
     *
     * @return Response
     */
    public function create()
    {
        return view('szamlas.create');
    }

    /**
     * Store a newly created szamla in storage.
     *
     * @param CreateszamlaRequest $request
     *
     * @return Response
     */
    public function store(CreateszamlaRequest $request)
    {
        $input = $request->all();

        if ( empty($input['partner'])) {
            $partner = new Partner;
            $partner->nev = $input['nev'];
            !empty($input['tipus']) ? $partner->tipus = $input['tipus'] : $partner->tipus = NULL;
            $partner->adoszam = $input['adoszam'];
            $partner->bankszamla = $input['bankszamla'];
            !empty($input['isz']) ? $partner->isz = $input['isz'] : $partner->isz = NULL;
            !empty($input['telepules']) ? $partner->telepules = $input['telepules'] : $partner->telepules = NULL;
            $partner->cim = $input['cim'];
            $partner->email = $input['email'];
            $partner->telefonszam = $input['telefonszam'];
            $partner->save();
            $input['partner'] = $partner->id;
        }

        $szamla = $this->szamlaRepository->create($input);

        return view('szamlatetels.createMe')->with('szamla', $szamla);
    }

    /**
     * Display the specified szamla.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $szamla = $this->szamlaRepository->find($id);

        if (empty($szamla)) {
            return redirect(route('szamlas.index'));
        }

        return view('szamlas.show')->with('szamla', $szamla);
    }

    /**
     * Show the form for editing the specified szamla.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $szamla = $this->szamlaRepository->find($id);

        if (empty($szamla)) {
            return redirect(route('szamlas.index'));
        }

        if ( $szamla->feldolgozott == 1 ) {
            Flash::error('Feldolgozott tétel nem módosítható!')->important();
            return redirect(route('szamlas.index'));
        }

        return view('szamlas.edit')->with('szamla', $szamla);
    }

    /**
     * Update the specified szamla in storage.
     *
     * @param int $id
     * @param UpdateszamlaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateszamlaRequest $request)
    {
        $szamla = $this->szamlaRepository->find($id);

        if (empty($szamla)) {
            return redirect(route('szamlas.index'));
        }

        $szamla = $this->szamlaRepository->update($request->all(), $id);
        return redirect(route('szamlas.index'));
    }

    /**
     * Remove the specified szamla from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $szamla = $this->szamlaRepository->find($id);

        if (empty($szamla)) {
            return redirect(route('szamlas.index'));
        }

        $this->szamlaRepository->delete($id);
        return redirect(route('szamlas.index'));
    }

    public function destroyMe($id)
    {
        $szamla = $this->szamlaRepository->find($id);

        if (empty($szamla)) {
            return redirect(route('szamlas.index'));
        }

        if ( $szamla->feldolgozott == 1 ) {
            Flash::error('Feldolgozott tétel nem törölhető!')->important();
            return redirect(route('szamlas.index'));
        }

        $this->szamlaRepository->delete($id);
        return redirect(route('szamlas.index'));
    }

}
