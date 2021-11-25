<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMozgasfejRequest;
use App\Http\Requests\UpdateMozgasfejRequest;
use App\Repositories\MozgasfejRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

use App\Models\Mozgasfej;
use App\Models\Mozgastetel;
use App\Classes\MozgasClass;
use App\Classes\MozgasKonyvelesClass;

class MozgasfejController extends AppBaseController
{
    /** @var  MozgasfejRepository */
    private $mozgasfejRepository;

    public function __construct(MozgasfejRepository $mozgasfejRepo)
    {
        $this->mozgasfejRepository = $mozgasfejRepo;
    }

    private function dataView($data) {

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('mozgasfejs.edit', [$row->id]) . '"
                                    class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                $btn = $btn.'<a href="' . route('BevetTorles', [$row->id]) . '"
                                    class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                $btn = $btn.'<a href="' . route('mozgasKonyveles', [$row->id]) . '"
                                    class="btn btn-warning btn-sm CsoportInsert" title="Könyvelés"><i class="glyphicon glyphicon-list-alt"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

    }

    public function mindenAdat()
    {

        return DB::table('mozgasfej')
                 ->join('mozgaskod', 'mozgaskod.id', '=', 'mozgasfej.mozgaskod_id')
                 ->join('partner', 'partner.id', '=', 'mozgasfej.partner')
                 ->join('dictionaries', 'dictionaries.id', '=', 'mozgasfej.raktar')
                 ->select('mozgasfej.*', 'mozgaskod.nev as mozgasnev', 'partner.nev as partnernev', 'dictionaries.nev as raktarnev',
                     DB::raw('(SELECT COUNT(*) FROM mozgastetel WHERE mozgastetel.mozgasfej = mozgasfej.id AND mozgastetel.deleted_at is null) as tetel'))
                 ->whereNull('mozgasfej.deleted_at')
                 ->get();

    }

    /**
     * Display a listing of the Mozgasfej.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                 return $this->dataView($this->mindenAdat());

            }

            return view('mozgasfejs.index');

         }
         return view('auth.login');
    }

    /**
     * Display a listing of the Mozgasfej.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexMozgasokTermek(Request $request, $id)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = DB::table('mozgastetel as t1')
                            ->join('mozgasfej as t2', 't2.id', '=', 't1.mozgasfej')
                            ->select('t2.datum', 't2.bizszam', DB::raw('sum(t1.mennyiseg) as mennyiseg'))
                            ->where('t1.termek', $id)
                            ->groupBy('t2.datum', 't2.bizszam')
                            ->get();

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->rawColumns(['action'])
                    ->make(true);

            }

            return view('mozgasfejs.index');

        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new Mozgasfej.
     *
     * @return Response
     */
     public function create()
     {
         return view('mozgasfejs.create');
     }

     public function felhasznalasCreate()
     {
         return view('mozgasfejs.felhasznalasCreate');
     }

    /**
     * Store a newly created Mozgasfej in storage.
     *
     * @param CreateMozgasfejRequest $request
     *
     * @return Response
     */
    public function store(CreateMozgasfejRequest $request, MozgasClass $mozgasClass)
    {
        $input = $request->all();

        $bizszam = $mozgasClass->kovetkezoBizszam($input['mozgaskod_id']);

        $data = array('datum' => $input['datum'],
                      'partner' => $input['partner'],
                      'mozgaskod_id' => $input['mozgaskod_id'],
                      'bizszam' => $bizszam,
                      'feldolgozott' => 0);

        $mozgasFej = $this->mozgasfejRepository->create($data);

        return redirect(route('BevetTetelInsert', $mozgasFej->id));
    }

    /**
     * Display the specified Mozgasfej.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mozgasfej = $this->mozgasfejRepository->find($id);

        if (empty($mozgasfej)) {
            return redirect(route('mozgasfejs.index'));
        }
        return view('mozgasfejs.show')->with('mozgasfej', $mozgasfej);
    }

    /**
     * Show the form for editing the specified Mozgasfej.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $mozgasfej = $this->mozgasfejRepository->find($id);

        if (empty($mozgasfej)) {
            return redirect(route('mozgasfejs.index'));
        }
        return view('mozgasfejs.edit')->with('mozgasfej', $mozgasfej);
    }

    public function felhasznalasEdit($id)
    {
        $mozgasfej = $this->mozgasfejRepository->find($id);

        if (empty($mozgasfej)) {
            return redirect(route('mozgasfejs.index'));
        }
        return view('mozgasfejs.felhasznalasEdit')->with('mozgasfej', $mozgasfej);
    }


    /**
     * Update the specified Mozgasfej in storage.
     *
     * @param int $id
     * @param UpdateMozgasfejRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMozgasfejRequest $request)
    {
        $mozgasfej = $this->mozgasfejRepository->find($id);
        if (empty($mozgasfej)) {
            return redirect(route('mozgasfejs.index'));
        }
        $mozgasfej = $this->mozgasfejRepository->update($request->all(), $id);
        return redirect(route('mozgasfejs.index'));
    }

    public function felhasznalasUpdate($id, UpdateMozgasfejRequest $request)
    {
        $mozgasfej = $this->mozgasfejRepository->find($id);
        if (empty($mozgasfej)) {
            return redirect(route('felhasznalasIndex'));
        }
        $mozgasfej = $this->mozgasfejRepository->update($request->all(), $id);
        return redirect(route('felhasznalasIndex'));
    }

    /**
     * Remove the specified Mozgasfej from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mozgasfej = $this->mozgasfejRepository->find($id);
        if (empty($mozgasfej)) {
            return redirect(route('mozgasfejs.index'));
        }
        $this->mozgasfejRepository->delete($id);
        return redirect(route('mozgasfejs.index'));
    }

    public function destroyMe($id)
    {
        $db = DB::table('mozgastetel')->where('mozgasfej', '=', $id)->whereNull('deleted_at')->count();
        if ($db ==  0){
            $mozgasfej = $this->mozgasfejRepository->find($id);
            if (empty($mozgasfej)) {
                return redirect(route('mozgasfejs.index'));
            }
            $this->mozgasfejRepository->delete($id);
        }else{
            Flash::error('Nem törölhető a tétel!')->important();
        }
        return redirect(route('mozgasfejs.index'));
    }

    public function destroyFMe($id)
    {
        $db = DB::table('mozgastetel')->where('mozgasfej', '=', $id)->whereNull('deleted_at')->count();
        if ($db ==  0){
            $mozgasfej = $this->mozgasfejRepository->find($id);
            if (empty($mozgasfej)) {
                return redirect(route('felhasznalasIndex'));
            }
            $this->mozgasfejRepository->delete($id);
        }else{
            Flash::error('Nem törölhető a tétel!');
        }
        return redirect(route('felhasznalasIndex'));
    }


    public function fBevetel($id, MozgasClass $mozgasClass)
    {
        $mozgasfej = $this->mozgasfejRepository->find($id);
        if (empty($mozgasfej)) {
            return redirect(route('felhasznalasIndex'));
        }else{
            if ($mozgasfej->feldolgozott != 1) {
                Flash::error('Nem másolható a tétel!');
                return redirect(route('mozgasfejs.edit', $id));
            }else{
                $ujFejId = $mozgasClass->felhasznalasbolBevet($id);
            };
        }
        return redirect(route('felhasznalasEdit', $ujFejId));
    }

    /**
     * Az adott bizonylat könyvelése
     *
     * @param App\Models\Mozgasfej->id
     *
     * @return void
     */
    public function mozgasKonyveles($id, MozgasKonyvelesClass $mkc) {

        //
        if ( Mozgasfej::where('id', $id)->first()->feldolgozott != 0 ) {

            Flash::error('A bizonylat már könyvelt, nem könyvelheti újra!')->important();

        } else {

            if ( Mozgastetel::where('mozgasfej', $id)->count() == 0 ) {

                Flash::error('A bizonylatnak nincsenek sorai, nem könyvelheti!')->important();

            } else {

                $mkc->mozgasKonyveles($id);

            }
        }

        return redirect(route('mozgasfejs.index'));

    }
}
