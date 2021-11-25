<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVevoirendelestetelRequest;
use App\Http\Requests\UpdateVevoirendelestetelRequest;
use App\Repositories\VevoirendelestetelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

use App\Models\Vevoirendelestetel;
use App\Models\Vevoirendelesfej;

class VevoirendelestetelController extends AppBaseController
{
    /** @var  VevoirendelestetelRepository */
    private $vevoirendelestetelRepository;

    public function __construct(VevoirendelestetelRepository $vevoirendelestetelRepo)
    {
        $this->vevoirendelestetelRepository = $vevoirendelestetelRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('termeknev', function($data) { return $data->termeknev; })
              ->addColumn('action', function($row){
                  $btn = '<a href="' . route('vevoirendelestetels.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                  $btn = $btn.'<a href="' . route('vevoirendelestetels.destroy', [$row->id]) . '"
                             class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                  return $btn;
              })
              ->rawColumns(['action'])
              ->make(true);
    }


    /**
     * Display a listing of the Vevoirendelestetel.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Vevoirendelestetel::all();
                return $this->dwData($data);

            }

            return view('vevoirendelestetels.index');
        }
    }


    /**
     * Display a listing of the Vevoirendelestetel.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexFejId(Request $request, $id)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Vevoirendelestetel::where('vevoirendelesfej_id', $id)->get();
                return $this->dwData($data);

            }

            return view('vevoirendelesfejs.index');
        }
    }

    /**
     * Show the form for creating a new Vevoirendelestetel.
     *
     * @return Response
     */
    public function create()
    {
        return view('vevoirendelestetels.create');
    }

    /**
     * Show the form for creating a new Vevoirendelestetel.
     *
     * @return Response
     */
    public function createMe($id)
    {
        $vevoirendelesfej = Vevoirendelesfej::where('id', $id)->first();
        return view('vevoirendelestetels.create')->with('vevoirendelesfej', $vevoirendelesfej);
    }

    /**
     * Store a newly created Vevoirendelestetel in storage.
     *
     * @param CreateVevoirendelestetelRequest $request
     *
     * @return Response
     */
    public function store(CreateVevoirendelestetelRequest $request)
    {
        $input = $request->all();

        $vevoirendelestetel = $this->vevoirendelestetelRepository->create($input);

        return redirect(route('vevoiRendelesTetelInsert', $vevoirendelestetel->vevoirendelesfej_id));
    }

    /**
     * Display the specified Vevoirendelestetel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vevoirendelestetel = $this->vevoirendelestetelRepository->find($id);

        if (empty($vevoirendelestetel)) {
            return redirect(route('vevoirendelestetels.index'));
        }

        return view('vevoirendelestetels.show')->with('vevoirendelestetel', $vevoirendelestetel);
    }

    /**
     * Show the form for editing the specified Vevoirendelestetel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vevoirendelestetel = $this->vevoirendelestetelRepository->find($id);

        if (empty($vevoirendelestetel)) {
            return redirect(route('vevoirendelestetels.index'));
        }

        return view('vevoirendelestetels.edit')->with('vevoirendelestetel', $vevoirendelestetel);
    }

    /**
     * Update the specified Vevoirendelestetel in storage.
     *
     * @param int $id
     * @param UpdateVevoirendelestetelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVevoirendelestetelRequest $request)
    {
        $vevoirendelestetel = $this->vevoirendelestetelRepository->find($id);

        if (empty($vevoirendelestetel)) {
            return redirect(route('vevoirendelestetels.index'));
        }

        $vevoirendelestetel = $this->vevoirendelestetelRepository->update($request->all(), $id);

        return redirect(route('vevoirendelestetels.index'));
    }

    /**
     * Remove the specified Vevoirendelestetel from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $vevoirendelestetel = $this->vevoirendelestetelRepository->find($id);

        if (empty($vevoirendelestetel)) {
            return redirect(route('vevoirendelestetels.index'));
        }

        $this->vevoirendelestetelRepository->delete($id);

        return redirect(route('vevoirendelestetels.index'));
    }
}
