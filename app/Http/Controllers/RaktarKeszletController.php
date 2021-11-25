<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRaktarKeszletRequest;
use App\Http\Requests\UpdateRaktarKeszletRequest;
use App\Models\RaktarKeszlet;
use App\Repositories\RaktarKeszletRepository;
use Auth;
use DataTables;
use Flash;
use Illuminate\Http\Request;
use Response;

class RaktarKeszletController extends AppBaseController
{
    /** @var  RaktarKeszletRepository */
    private $raktarKeszletRepository;

    public function __construct(RaktarKeszletRepository $raktarKeszletRepo)
    {
        $this->raktarKeszletRepository = $raktarKeszletRepo;
    }

    private function dataView($data) {
        return Datatables::of($data)
            ->addIndexColumn()

            ->addColumn('raktarnev', function($data) { return $data->raktarnev; })
            ->addColumn('termeknev', function($data) { return $data->termeknev; })

            ->addColumn('action', function($row){
                $btn = '<a href="' . route('raktarKeszlets.edit', [$row->id]) . '"
                                   class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                $btn = $btn.'<a href="' . route('raktarKeszlets.destroy', [$row->id]) . '"
                                   class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Display a listing of the RaktarKeszlet.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
      if( Auth::check() ){

        if ($request->ajax()) {

            $data = RaktarKeszlet::all();
            return $this->dataView($data);

        }

        return view('raktar_keszlets.index');

       }
       return view('auth.login');
    }

    /**
     * Show the form for creating a new RaktarKeszlet.
     *
     * @return Response
     */
    public function create()
    {
        return view('raktar_keszlets.create');
    }

    /**
     * Store a newly created RaktarKeszlet in storage.
     *
     * @param CreateRaktarKeszletRequest $request
     *
     * @return Response
     */
    public function store(CreateRaktarKeszletRequest $request)
    {
        $input = $request->all();

        $raktarKeszlet = $this->raktarKeszletRepository->create($input);

        Flash::success('Raktar Keszlet saved successfully.');

        return redirect(route('raktarKeszlets.index'));
    }

    /**
     * Display the specified RaktarKeszlet.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $raktarKeszlet = $this->raktarKeszletRepository->find($id);

        if (empty($raktarKeszlet)) {
            Flash::error('Raktar Keszlet not found');

            return redirect(route('raktarKeszlets.index'));
        }

        return view('raktar_keszlets.show')->with('raktarKeszlet', $raktarKeszlet);
    }

    /**
     * Show the form for editing the specified RaktarKeszlet.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $raktarKeszlet = $this->raktarKeszletRepository->find($id);

        if (empty($raktarKeszlet)) {
            Flash::error('Raktar Keszlet not found');

            return redirect(route('raktarKeszlets.index'));
        }

        return view('raktar_keszlets.edit')->with('raktarKeszlet', $raktarKeszlet);
    }

    /**
     * Update the specified RaktarKeszlet in storage.
     *
     * @param int $id
     * @param UpdateRaktarKeszletRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRaktarKeszletRequest $request)
    {
        $raktarKeszlet = $this->raktarKeszletRepository->find($id);

        if (empty($raktarKeszlet)) {
            Flash::error('Raktar Keszlet not found');

            return redirect(route('raktarKeszlets.index'));
        }

        $raktarKeszlet = $this->raktarKeszletRepository->update($request->all(), $id);

        Flash::success('Raktar Keszlet updated successfully.');

        return redirect(route('raktarKeszlets.index'));
    }

    /**
     * Remove the specified RaktarKeszlet from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $raktarKeszlet = $this->raktarKeszletRepository->find($id);

        if (empty($raktarKeszlet)) {
            Flash::error('Raktar Keszlet not found');

            return redirect(route('raktarKeszlets.index'));
        }

        $this->raktarKeszletRepository->delete($id);

        Flash::success('Raktar Keszlet deleted successfully.');

        return redirect(route('raktarKeszlets.index'));
    }

    public function rkindex(Request $request, $id)
    {
      if( Auth::check() ){

        if ($request->ajax()) {

            $data = RaktarKeszlet::where('termek_id', $id)->get();
            return $this->dataView($data);

        }

        return view('raktar_keszlets.index');

       }
       return view('auth.login');
    }

}
