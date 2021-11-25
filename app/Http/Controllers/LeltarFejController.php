<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLeltarFejRequest;
use App\Http\Requests\UpdateLeltarFejRequest;
use App\Models\LeltarFej;
use App\Models\LeltarTetel;
use App\Repositories\LeltarFejRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;


class LeltarFejController extends AppBaseController
{
    /** @var  LeltarFejRepository */
    private $leltarFejRepository;

    public function __construct(LeltarFejRepository $leltarFejRepo)
    {
        $this->leltarFejRepository = $leltarFejRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('raktarnev', function($data) { return $data->raktarnev; })
            ->addColumn('tetelszam', function($data) { return $data->tetelszam; })
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('leltarTetelCreate', [$row->id]) . '"
                                   class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                $btn = $btn.'<a href="' . route('LeltarTorles', [$row->id]) . '"
                                   class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Display a listing of the LeltarFej.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {


                $data = LeltarFej::all();
                return $this->dwData($data);

            }

            return view('leltar_fejs.index');

        }
    }

    /**
     * Show the form for creating a new LeltarFej.
     *
     * @return Response
     */
    public function create()
    {
        return view('leltar_fejs.create');
    }

    /**
     * Store a newly created LeltarFej in storage.
     *
     * @param CreateLeltarFejRequest $request
     *
     * @return Response
     */
    public function store(CreateLeltarFejRequest $request)
    {
        $input = $request->all();
        $leltarFej = $this->leltarFejRepository->create($input);

        return redirect(route('leltarTetelCreate', $leltarFej->id));
    }

    /**
     * Display the specified LeltarFej.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $leltarFej = $this->leltarFejRepository->find($id);

        if (empty($leltarFej)) {
            Flash::error('Leltar Fej not found');

            return redirect(route('leltarFejs.index'));
        }

        return view('leltar_fejs.show')->with('leltarFej', $leltarFej);
    }

    /**
     * Show the form for editing the specified LeltarFej.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $leltarTetelek = LeltarTetel::where('leltarfej_id', $id)->count();
        if ( $leltarTetelek != 0 ) {

            Flash::error('Nem módosítható a tétel, vannak leltár tételek!')->important();
            return redirect(route('leltarFejs.index'));
        }

        $leltarFej = $this->leltarFejRepository->find($id);

        if (empty($leltarFej)) {
            Flash::error('Leltar Fej not found');
            return redirect(route('leltarFejs.index'));
        }

        return view('leltar_fejs.edit')->with('leltarFej', $leltarFej);
    }

    /**
     * Update the specified LeltarFej in storage.
     *
     * @param int $id
     * @param UpdateLeltarFejRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLeltarFejRequest $request)
    {
        $leltarFej = $this->leltarFejRepository->find($id);

        if (empty($leltarFej)) {
            Flash::error('Leltar Fej not found');

            return redirect(route('leltarFejs.index'));
        }

        $leltarFej = $this->leltarFejRepository->update($request->all(), $id);

        Flash::success('Leltar Fej updated successfully.');

        return redirect(route('leltarFejs.index'));
    }

    /**
     * Remove the specified LeltarFej from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $leltarTetelek = LeltarTetel::where('leltarfej_id', $id)->count();

        dd($leltarTetelek);

        if ( $leltarTetelek != 0 ) {
            Flash::error('Nem törölhető a tétel, vannak leltár tételek!')->important();
            return redirect(route('leltarFejs.index'));
        }

        $leltarFej = $this->leltarFejRepository->find($id);

        if (empty($leltarFej)) {
            Flash::error('Leltar Fej not found');
            return redirect(route('leltarFejs.index'));
        }

        $this->leltarFejRepository->delete($id);

        return redirect(route('leltarFejs.index'));
    }

    /**
     * Remove the specified LeltarFej from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroyMe($id)
    {
        $leltarTetelek = LeltarTetel::where('leltarfej_id', $id)->count();

        if ( $leltarTetelek != 0 ) {
            Flash::error('Nem törölhető a tétel, vannak leltár tételek!')->important();
            return redirect(route('leltarFejs.index'));
        }

        $leltarFej = $this->leltarFejRepository->find($id);

        if (empty($leltarFej)) {
            Flash::error('Leltar Fej not found');
            return redirect(route('leltarFejs.index'));
        }

        $this->leltarFejRepository->delete($id);

        return redirect(route('leltarFejs.index'));
    }
}
