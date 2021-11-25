<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMegrendelesfejRequest;
use App\Http\Requests\UpdateMegrendelesfejRequest;
use App\Repositories\MegrendelesfejRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;
use App\Models\Megrendelesfej;

class MegrendelesfejController extends AppBaseController
{
    /** @var  MegrendelesfejRepository */
    private $megrendelesfejRepository;

    public function __construct(MegrendelesfejRepository $megrendelesfejRepo)
    {
        $this->megrendelesfejRepository = $megrendelesfejRepo;
    }

    /**
     * Display a listing of the Megrendelesfej.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

          if ($request->ajax()) {

            $data = DB::table('megrendelesfej')
                        ->join('partner as t1', 't1.id', '=', 'megrendelesfej.partner')
                        ->select('megrendelesfej.*', 't1.nev as nev', DB::raw('megrendelesErtek(megrendelesfej.id) ertek'))
                        ->whereNull('megrendelesfej.deleted_at')
                        ->get();


              return Datatables::of($data)
                      ->addIndexColumn()
                      ->addColumn('action', function($row){
                            $btn = '<a href="' . route('megrendelesfejs.edit', [$row->id]) . '"
                                    class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                            $btn = $btn.'<a href="' . route('megrendelesTorles', [$row->id]) . '"
                                    class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                            $btn = $btn.'<a href="' . route('megrendelesNyomtatas', [$row->id]) . '"
                                    class="btn btn-warning btn-sm deleteProduct" title="Nyomtatás"><i class="glyphicon glyphicon-print"></i></a>';
                        return $btn;
                      })
                      ->rawColumns(['action'])
                      ->make(true);
          }

          return view('megrendelesfejs.index');

         }
         return view('auth.login');
    }

    /**
     * Show the form for creating a new Megrendelesfej.
     *
     * @return Response
     */
    public function create()
    {
        return view('megrendelesfejs.create');
    }

    /**
     * Store a newly created Megrendelesfej in storage.
     *
     * @param CreateMegrendelesfejRequest $request
     *
     * @return Response
     */
    public function store(CreateMegrendelesfejRequest $request)
    {
        $input = $request->all();
        $megrendelesSzam = Megrendelesfej::max('megrendelesszam');
        if ( !is_null($megrendelesSzam) ) {
            $szam = strval(intval(substr($megrendelesSzam,2)) + 1);
            $input['megrendelesszam'] = 'M-'.str_pad('', 6 - strlen($szam), '0').$szam;

        } else {
            $input['megrendelesszam'] = "M-000001";
        }
        $megrendelesfej = $this->megrendelesfejRepository->create($input);
        return view('megrendelestetels.create')->with('id', $megrendelesfej['id']);
    }

    /**
     * Display the specified Megrendelesfej.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $megrendelesfej = $this->megrendelesfejRepository->find($id);

        if (empty($megrendelesfej)) {
            return redirect(route('megrendelesfejs.index'));
        }

        return view('megrendelesfejs.show')->with('megrendelesfej', $megrendelesfej);
    }

    /**
     * Show the form for editing the specified Megrendelesfej.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $megrendelesfej = $this->megrendelesfejRepository->find($id);

        if (empty($megrendelesfej)) {
            return redirect(route('megrendelesfejs.index'));
        }

        return view('megrendelesfejs.edit')->with('megrendelesfej', $megrendelesfej);
    }

    /**
     * Update the specified Megrendelesfej in storage.
     *
     * @param int $id
     * @param UpdateMegrendelesfejRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMegrendelesfejRequest $request)
    {
        $megrendelesfej = $this->megrendelesfejRepository->find($id);

        if (empty($megrendelesfej)) {
            return redirect(route('megrendelesfejs.index'));
        }

        $megrendelesfej = $this->megrendelesfejRepository->update($request->all(), $id);
        return redirect(route('megrendelesfejs.index'));
    }

    /**
     * Remove the specified Megrendelesfej from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $megrendelesfej = $this->megrendelesfejRepository->find($id);

        if (empty($megrendelesfej)) {
            return redirect(route('megrendelesfejs.index'));
        }

        $this->megrendelesfejRepository->delete($id);
        return redirect(route('megrendelesfejs.index'));
    }

    public function destroyMe($id)
    {
        $db = DB::table('megrendelestetel')->where('megrendelesfej', '=', $id)->whereNull('deleted_at')->count();
        if ($db == 0){
            $megrendelesfej = $this->megrendelesfejRepository->find($id);

            if (empty($megrendelesfej)) {
                return redirect(route('megrendelesfejs.index'));
            }
            $this->megrendelesfejRepository->delete($id);
        }else{
            Flash::error('Nem törölhető a tétel!');
        }
        return redirect(route('megrendelesfejs.index'));
    }

    public function nyomtatas($id)
    {

        $megrendelesfej = $this->megrendelesfejRepository->find($id);

        if (empty($megrendelesfej)) {
            return redirect(route('megrendelesfejs.index'));
        }

        return view('megrendelesfejs.nyomtatas')->with('megrendelesfej', $megrendelesfej);;
    }


}
