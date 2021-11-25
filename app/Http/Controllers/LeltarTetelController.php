<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLeltarTetelRequest;
use App\Http\Requests\UpdateLeltarTetelRequest;
use App\Repositories\LeltarTetelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

use App\Models\LeltarFej;
use App\Models\LeltarTetel;
use App\Models\Termek;
class LeltarTetelController extends AppBaseController
{
    /** @var  LeltarTetelRepository */
    private $leltarTetelRepository;

    public function __construct(LeltarTetelRepository $leltarTetelRepo)
    {
        $this->leltarTetelRepository = $leltarTetelRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('termeknev', function($data) { return $data->termeknev; })
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('leltarFejs.edit', [$row->id]) . '"
                                   class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                $btn = $btn.'<a href="' . route('leltarFejs.destroy', [$row->id]) . '"
                                   class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Display a listing of the LeltarTetel.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexLeltarTetel(Request $request, $id)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = LeltarTetel::where('leltarfej_id', $id)->get();
                return $this->dwData($data);

            }

            return view('leltar_tetels.index');

        }
    }

    /**
     * Display a listing of the LeltarTetel.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = LeltarTetel::all();
                return $this->dwData($data);

            }

            return view('leltar_tetels.index');

        }
    }

    /**
     * Show the form for creating a new LeltarTetel.
     *
     * @return Response
     */
    public function create($id)
    {
        $leltarFej = LeltarFej::where('id', $id)->first();
        return view('leltar_tetels.create')->with('leltarFej', $leltarFej);
    }

    /**
     * Show the form for creating a new LeltarTetel.
     *
     * @return Response
     */
    public function createMy($id)
    {
        $leltarFej = LeltarFej::where('id', $id)->first();
        return view('leltar_tetels.create')->with('leltarFej', $leltarFej);
    }

    /**
     * Store a newly created LeltarTetel in storage.
     *
     * @param CreateLeltarTetelRequest $request
     *
     * @return Response
     */
    public function store(CreateLeltarTetelRequest $request)
    {
        $input = $request->all();
        if ( !empty($input['termek_nev']) ) {
            $termek = Termek::create([
                'nev' => $input['termek_nev'],
                'csoport' => $input['termek_csoport'],
                'partner' => $input['termek_partner'],
                'cikkszam' => $input['termek_cikkszam'],
                'barcode' => $input['barcode'],
                'me' => $input['termek_me'],
                'minmenny' => $input['termek_minmenny'],
                'mennyiseg' => 0,
                'beszar' => $input['termek_beszar'],
                'ar' => $input['termek_ar']
            ]);
            $input['termek_id'] = $termek->id;
        }

        $leltarTetel = $this->leltarTetelRepository->create($input);

        $leltarFej = LeltarFej::where('id', $leltarTetel->leltarfej_id)->first();
        return view('leltar_tetels.create')->with('leltarFej', $leltarFej);
    }

    /**
     * Display the specified LeltarTetel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $leltarTetel = $this->leltarTetelRepository->find($id);

        if (empty($leltarTetel)) {
            Flash::error('Leltar Tetel not found');

            return redirect(route('leltarTetels.index'));
        }

        return view('leltar_tetels.show')->with('leltarTetel', $leltarTetel);
    }

    /**
     * Show the form for editing the specified LeltarTetel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $leltarTetel = $this->leltarTetelRepository->find($id);

        if (empty($leltarTetel)) {
            Flash::error('Leltar Tetel not found');

            return redirect(route('leltarTetels.index'));
        }

        return view('leltar_tetels.edit')->with('leltarTetel', $leltarTetel);
    }

    /**
     * Update the specified LeltarTetel in storage.
     *
     * @param int $id
     * @param UpdateLeltarTetelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLeltarTetelRequest $request)
    {
        $leltarTetel = $this->leltarTetelRepository->find($id);

        if (empty($leltarTetel)) {
            Flash::error('Leltar Tetel not found');

            return redirect(route('leltarTetels.index'));
        }

        $leltarTetel = $this->leltarTetelRepository->update($request->all(), $id);

        Flash::success('Leltar Tetel updated successfully.');

        return redirect(route('leltarTetels.index'));
    }

    /**
     * Remove the specified LeltarTetel from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $leltarTetel = $this->leltarTetelRepository->find($id);

        if (empty($leltarTetel)) {
            Flash::error('Leltar Tetel not found');

            return redirect(route('leltarTetels.index'));
        }

        $this->leltarTetelRepository->delete($id);

        Flash::success('Leltar Tetel deleted successfully.');

        return redirect(route('leltarTetels.index'));
    }
}
