<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePenztarTetelRequest;
use App\Http\Requests\UpdatePenztarTetelRequest;
use App\Models\PenztarFej;
use App\Models\PenztarTetel;
use App\Repositories\PenztarTetelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

class PenztarTetelController extends AppBaseController
{
    /** @var  PenztarTetelRepository */
    private $penztarTetelRepository;

    public function __construct(PenztarTetelRepository $penztarTetelRepo)
    {
        $this->penztarTetelRepository = $penztarTetelRepo;
    }

    /**
     * Display a listing of the PenztarTetel.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $penztarTetels = $this->penztarTetelRepository->all();

        return view('penztar_tetels.index')
            ->with('penztarTetels', $penztarTetels);
    }

    /**
     * Display a listing of the PenztarTetel.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexTetel(Request $request, $id)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = PenztarTetel::where('penztarfej_id', $id)->get();

                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('termek', function($data) { return $data->termek; })
                        ->addColumn('action', function($row){
                            $btn = '<a href="' . route('pentarTetelTorles', [$row->id]) . '"
                                       class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }

            return view('penztarTetels.index');

        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new PenztarTetel.
     *
     * @return Response
     */
    public function create()
    {
        return view('penztar_tetels.create');
    }

    /**
     * Show the form for creating a new PenztarTetel.
     *
     * @return Response
     */
    public function createMe($penztarFej)
    {
        return view('penztar_tetels.create', $penztarFej);
    }

    /**
     * Store a newly created PenztarTetel in storage.
     *
     * @param CreatePenztarTetelRequest $request
     *
     * @return Response
     */
    public function store(CreatePenztarTetelRequest $request)
    {
        $input = $request->all();
        $penztarTetel = $this->penztarTetelRepository->create($input);
        $penztarFej = PenztarFej::where('id', $penztarTetel->penztarfej_id)->first();
        return view('penztar_tetels.create')->with('penztarFej', $penztarFej);;
    }

    /**
     * Display the specified PenztarTetel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $penztarTetel = $this->penztarTetelRepository->find($id);

        if (empty($penztarTetel)) {
            Flash::error('Penztar Tetel not found');

            return redirect(route('penztarTetels.index'));
        }

        return view('penztar_tetels.show')->with('penztarTetel', $penztarTetel);
    }

    /**
     * Show the form for editing the specified PenztarTetel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $penztarTetel = $this->penztarTetelRepository->find($id);

        if (empty($penztarTetel)) {
            Flash::error('Penztar Tetel not found');

            return redirect(route('penztarTetels.index'));
        }

        return view('penztar_tetels.edit')->with('penztarTetel', $penztarTetel);
    }

    /**
     * Update the specified PenztarTetel in storage.
     *
     * @param int $id
     * @param UpdatePenztarTetelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePenztarTetelRequest $request)
    {
        $penztarTetel = $this->penztarTetelRepository->find($id);

        if (empty($penztarTetel)) {
            Flash::error('Penztar Tetel not found');

            return redirect(route('penztarTetels.index'));
        }

        $penztarTetel = $this->penztarTetelRepository->update($request->all(), $id);

        Flash::success('Penztar Tetel updated successfully.');

        return redirect(route('penztarTetels.index'));
    }

    /**
     * Remove the specified PenztarTetel from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $penztarTetel = $this->penztarTetelRepository->find($id);

        if (empty($penztarTetel)) {
            return redirect(route('penztarTetels.index'));
        }

        $this->penztarTetelRepository->delete($id);
        $penztarFej = PenztarFej::where('id', $penztarTetel->penztarfej_id)->first();

        return view('penztar_tetels.create')->with('penztarFej', $penztarFej);;
    }
}
