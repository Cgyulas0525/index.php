<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatetermekRequest;
use App\Http\Requests\UpdatetermekRequest;
use App\Models\Partner;
use App\Repositories\termekRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Scalar\String_;
use Response;
use Auth;
use DB;
use DataTables;
use PDF;

use App\Models\Termek;
use App\Models\Termekcsoport;

class termekController extends AppBaseController
{
    /** @var  termekRepository */
    private $termekRepository;

    public function __construct(termekRepository $termekRepo)
    {
        $this->termekRepository = $termekRepo;
    }

    public function termekData()
    {
        return DB::table('termek')
            ->join('termekcsoport', 'termekcsoport.id', '=', 'termek.csoport')
            ->join('termekfocsoport', 'termekfocsoport.id', '=', 'termekcsoport.focsoport')
            ->join('dictionaries', 'dictionaries.id', '=', 'termek.me')
            ->join('partner', 'partner.id', '=', 'termek.partner')
            ->leftjoin('kep', function($join)
            {
                $join->on('kep.parent_id', '=', 'termek.id')
                    ->where('kep.dictionary_id', '=', 2111)
                    ->where('kep.fokep', '=', 1);
            })
            ->select('termek.*', 'termekcsoport.nev as csnev', 'termekfocsoport.nev as focsoportnev', 'termekcsoport.focsoport',
                'dictionaries.nev as menev', 'partner.nev as pnev', 'kep.kicsikep as fokep', \DB::raw('substr(termek.cikkszam, 1, 1) as csz'))
            ->whereNull('termek.deleted_at')
            ->get();

    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('termekKarton', [$row->id]) . '"
                               class="btn btn-info btn-sm CsoportInsert" title="Karton"><i class="glyphicon glyphicon-book"></i></a>';
                $btn = $btn.'<a href="' . route('termeks.edit', [$row->id]) . '"
                                   class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                $btn = $btn.'<a href="' . route('TermekTorles', [$row->id]) . '"
                                   class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                $btn = $btn.'<a href="' . route('raktarkeszlet', [$row->id]) . '"
                               class="btn btn-warning btn-sm CsoportInsert" title="Raktár készlet"><i class="glyphicon glyphicon-list-alt"></i></a>';
                $btn = $btn.'<a href="' . route('editBarcode', [$row->id]) . '"
                               class="btn btn-primary btn-sm CsoportInsert" title="Vonalkód"><i class="glyphicon glyphicon-barcode"></i></a>';
                $btn = $btn.'<a href="' . route('createFocsoportKep', [$row->id, 2111]) . '"
                                         class="btn btn-danger btn-sm deleteProduct" title="Kép"><i class="glyphicon glyphicon-picture"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function dataMind()
    {
        $data = $this->termekData();
        return $data;
    }

    /**
     * Display a listing of the termek.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexUres(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Termek::where('id', 491)->get();
                return $this->dwData($data);

            }

            return view('termeks.index');

        }
        return view('auth.login');
    }

    /**
     * Display a listing of the termek.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = $this->dataMind();

                return $this->dwData($data);

            }

            return view('termeks.index');

        }
        return view('auth.login');
    }

    /**
     * Display a listing of the termek.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexCsoport(Request $request, $id)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = $this->termekData();
                $data = $data->where('csoport', '=', $id);
                return $this->dwData($data);


            }

            return view('termeks.index');

        }
        return view('auth.login');
    }

    /**
     * Display a listing of the termek.
     *
     * @param Request $request
     * @param String $melyik
     *
     * @return Response
     */
    public function indexSzurt(Request $request, $melyik)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                if ($melyik == 'Mind') {

                    $data = $this->dataMind();

                }

                if ($melyik == 'Barcode') {

                    $data = $this->termekData();
                    $data = $data->where('barcode', NULL);
                    $data = $data->where('csz', 'T');

                }

                return $this->dwData($data);

            }

            return view('termeks.index');

        }
        return view('auth.login');
    }

    /**
     * Display a listing of the termek.
     *
     * @param Request $request
     * @param Integer $tipus
     * @param Integer $partner
     *
     * @return Response
     */
    public function indexFiltered(Request $request, $focsoport, $tipus, $partner)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = $this->termekData();

                if ($focsoport != -99999) {
                    $data = $data->where('focsoport', $focsoport);
                }
                if ($tipus != -99999) {
                    $data = $data->where('csoport', $tipus);
                }
                if ($partner != -99999) {
                    $data = $data->where('partner', $partner);
                }

                return $this->dwData($data);

            }

            return view('termeks.index');

        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new termek.
     *
     * @return Response
     */
    public function create()
    {
        return view('termeks.create');
    }


    /**
     * Show the form for creating a new termek.
     *
     * @return Response
     */
    public function createWithTermekcsoport($id)
    {
        $termekcsoport = Termekcsoport::find($id);

        return view('termeks.createWithTermekcsoport')->with('termekcsoport', $termekcsoport);
    }

    /**
     * Store a newly created termek in storage.
     *
     * @param CreatetermekRequest $request
     *
     * @return Response
     */
    public function store(CreatetermekRequest $request)
    {
        $input = $request->all();

        if ( !empty($input['partner_nev']) ) {
            $partner = new Partner;
            $partner->nev = $input['partner_nev'];
            !empty($input['partner_tipus']) ? $partner->tipus = $input['partner_tipus'] : $partner->tipus = NULL;
            !empty($input['partner_adoszam']) ? $partner->adoszam = $input['partner_adoszam'] : $partner->adoszam = NULL;
            !empty($input['partner_bankszamla']) ? $partner->bankszamla = $input['partner_bankszamla'] : $partner->bankszamla = NULL;
            !empty($input['partner_isz']) ? $partner->isz = $input['partner_isz'] : $partner->isz = NULL;
            !empty($input['partner_telepules']) ? $partner->telepules = $input['partner_telepules'] : $partner->telepules = NULL;
            !empty($input['partner_email']) ? $partner->email = $input['partner_email'] : $partner->email = NULL;
            !empty($input['partner_telefonszam']) ? $partner->telefonszam = $input['partner_telefonszam'] : $partner->telefonszam = NULL;
            $partner->save();
            $input['partner'] = $partner->id;
        }

        $termek = $this->termekRepository->create($input);
        return redirect(route('termeks.create'));
    }

    /**
     * Display the specified termek.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $termek = $this->termekRepository->find($id);

        if (empty($termek)) {
            return redirect(route('termeks.index'));
        }

        return view('termeks.show')->with('termek', $termek);
    }

    /**
     * Show the form for editing the specified termek.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $termek = $this->termekRepository->find($id);

        if (empty($termek)) {
            return redirect(route('termeks.index'));
        }

        return view('termeks.edit')->with('termek', $termek);
    }

    /**
     * Show the form for editing the specified termek.
     *
     * @param int $id
     *
     * @return Response
     */
    public function editBarcode($id)
    {
        $termek = $this->termekRepository->find($id);

        if (empty($termek)) {
            return redirect(route('termeks.index'));
        }

        return view('termeks.editBarcode')->with('termek', $termek);
    }

    /**
     * Update the specified termek in storage.
     *
     * @param int $id
     * @param UpdatetermekRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetermekRequest $request)
    {
        $termek = $this->termekRepository->find($id);

        if (empty($termek)) {
            return redirect(route('termeks.index'));
        }

        $termek = $this->termekRepository->update($request->all(), $id);

        if (empty($request->glutenmentes)) {
            $termek->glutenmentes = 0;
        }
        if (empty($request->laktozmentes)) {
            $termek->laktozmentes = 0;
        }
        if (empty($request->tejmentes)) {
            $termek->tejmentes = 0;
        }
        if (empty($request->tojasmentes)) {
            $termek->tojasmentes = 0;
        }
        if (empty($request->cukormentes)) {
            $termek->cukormentes = 0;
        }
        if (empty($request->vegan)) {
            $termek->vegan = 0;
        }

        $termek->save();

        return redirect(route('termeks.index'));
    }

    /**
     * Update the specified termek in storage.
     *
     * @param int $id
     * @param UpdatetermekRequest $request
     *
     * @return Response
     */
    public function updateBarcode($id, UpdatetermekRequest $request)
    {
        $termek = $this->termekRepository->find($id);

        if (empty($termek)) {
            return redirect(route('termeks.index'));
        }

        $termek = $this->termekRepository->update($request->all(), $id);

        $nev = Termek::whereNull('barcode')->where('partner', $termek->partner)->min('nev');
        if (!empty($nev)) {
            $kTermek = Termek::where('nev', $nev)->first();
            $termek = $this->termekRepository->find($kTermek->id);
            return view('termeks.editBarcode')->with('termek', $termek);
        }
        return redirect(route('termeks.index'));
    }

    /**
     * Remove the specified termek from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $termek = $this->termekRepository->find($id);

        if (empty($termek)) {
            return redirect(route('termeks.index'));
        }

        $this->termekRepository->delete($id);
        return redirect(route('termeks.index'));
    }

    public function destroyMe($id)
    {
        $termek = $this->termekRepository->find($id);

        if (empty($termek)) {
            return redirect(route('termeks.index'));
        }

        $this->termekRepository->delete($id);
        return redirect(route('termeks.index'));
    }

    public function raktarkeszlet($id)
    {
        $termek = $this->termekRepository->find($id);

        if (empty($termek)) {
            return redirect(route('termeks.index'));
        }

        if ($termek->tsz != 2071) {
            Flash::error('Szolgáltatásnak nincs raktár készlete!')->important();
            return redirect(route('termeks.index'));
        }

        return view('termeks.karton')->with('termek', $termek);
    }

    public function vnNyomtatas()
    {
        $termekek = Termek::whereNull('barcode')->orderBy('nev')->get();

        if ($termekek->count() === 0) {

            Flash::warning('Nincs nyomtatandó tétel!')->important();
            return view('termeks.index');

        }

        return view('nyomtatas.vnnyomtatas')->with(['termekek' => $termekek]);

    }

    public function vnSzolgaltatasNyomtatas()
    {
        $termekek = DB::table('termek as t1')
            ->join('termekcsoport as t2', 't2.id', '=','t1.csoport')
            ->join('termekfocsoport as t3', 't3.id', '=', 't2.focsoport')
            ->select('t1.*')
            ->whereNull('barcode')
            ->where('t3.tsz', 2072)
            ->orderBy('t1.nev')
            ->get();

        if ($termekek->count() === 0) {

            Flash::warning('Nincs nyomtatandó tétel!')->important();
            return view('termeks.index');

        }

        return view('nyomtatas.vnnyomtatas')->with(['termekek' => $termekek]);

    }

    public function vnTermekNyomtatas()
    {
        $termekek = DB::table('termek as t1')
            ->join('termekcsoport as t2', 't2.id', '=','t1.csoport')
            ->join('termekfocsoport as t3', 't3.id', '=', 't2.focsoport')
            ->select('t1.*')
            ->whereNull('barcode')
            ->where('t3.tsz', 2071)
            ->orderBy('t1.nev')
            ->get();

        if ($termekek->count() === 0) {

            Flash::warning('Nincs nyomtatandó tétel!')->important();
            return view('termeks.index');

        }

        return view('nyomtatas.vnnyomtatas')->with(['termekek' => $termekek]);

    }


    public function vnPekaruNyomtatas()
    {
        $termekek = DB::table('termek as t1')
            ->join('termekcsoport as t2', 't2.id', '=','t1.csoport')
            ->join('termekfocsoport as t3', 't3.id', '=', 't2.focsoport')
            ->select('t1.*')
            ->whereNull('barcode')
            ->where('t3.nev', 'Pékáruk')
            ->orderBy('t1.nev')
            ->get();

        if ($termekek->count() === 0) {

            Flash::warning('Nincs nyomtatandó tétel!')->important();
            return view('termeks.index');

        }

        return view('nyomtatas.vnnyomtatas')->with(['termekek' => $termekek]);

    }

    public function mindenTermekNyomtatas()
    {
        $termekek = DB::table('termek as t1')
            ->join('termekcsoport as t2', 't2.id', '=', 't1.csoport')
            ->join('termekfocsoport as t3', 't3.id', '=', 't2.focsoport')
            ->join('dictionaries as t4', 't4.id', '=', 't1.me')
            ->select('t1.*', 't2.nev as csoportnev', 't4.nev as menev')
            ->where('t3.tsz', 2071)
            ->orderBy('csoportnev', 'asc')
            ->orderBy( 'nev', 'asc')
            ->get();

        if (empty($termekek)) {

            Flash::warning('Nincs nyomtatandó tétel!')->important();
            return view('termeks.index');

        }

        return view('nyomtatas.mindenTermekNyomtatas')->with(['termekek' => $termekek]);

    }

    /**
     * Display the specified termek.
     *
     * @param int $id
     *
     * @return Response
     */
    public function termekKarton($id)
    {

        $termek = $this->termekRepository->find($id);

        if (empty($termek)) {
            return redirect(route('termeks.index'));
        }

        return view('termeks.show')->with('termek', $termek);
    }
}
