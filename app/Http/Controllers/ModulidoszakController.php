<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateModulidoszakRequest;
use App\Http\Requests\UpdateModulidoszakRequest;
use App\Repositories\ModulidoszakRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

use App\Models\Modulidoszak;

class ModulidoszakController extends AppBaseController
{
    /** @var  ModulidoszakRepository */
    private $modulidoszakRepository;

    public function __construct(ModulidoszakRepository $modulidoszakRepo)
    {
        $this->modulidoszakRepository = $modulidoszakRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('modulnev', function($data) { return $data->modulnev; })
              ->addColumn('szotarnev', function($data) { return $data->szotarnev; })
              ->addColumn('action', function($row){
                  $btn = '<a href="' . route('modulidoszaks.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                  $btn = $btn.'<a href="' . route('modulidoszaks.destroy', [$row->id]) . '"
                             class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                  return $btn;
              })
              ->rawColumns(['action'])
              ->make(true);
    }


    /**
     * Display a listing of the Modulidoszak.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Modulidoszak::all();
                return $this->dwData($data);

            }

            return view('modulidoszaks.index');
        }
    }

    /**
     * Show the form for creating a new Modulidoszak.
     *
     * @return Response
     */
    public function create()
    {
        return view('modulidoszaks.create');
    }

    /**
     * Store a newly created Modulidoszak in storage.
     *
     * @param CreateModulidoszakRequest $request
     *
     * @return Response
     */
    public function store(CreateModulidoszakRequest $request)
    {
        $input = $request->all();

        $modulidoszak = $this->modulidoszakRepository->create($input);

        return redirect(route('modulidoszaks.index'));
    }

    /**
     * Display the specified Modulidoszak.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $modulidoszak = $this->modulidoszakRepository->find($id);

        if (empty($modulidoszak)) {
            return redirect(route('modulidoszaks.index'));
        }

        return view('modulidoszaks.show')->with('modulidoszak', $modulidoszak);
    }

    /**
     * Show the form for editing the specified Modulidoszak.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $modulidoszak = $this->modulidoszakRepository->find($id);

        if (empty($modulidoszak)) {
            return redirect(route('modulidoszaks.index'));
        }

        return view('modulidoszaks.edit')->with('modulidoszak', $modulidoszak);
    }

    /**
     * Update the specified Modulidoszak in storage.
     *
     * @param int $id
     * @param UpdateModulidoszakRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateModulidoszakRequest $request)
    {
        $modulidoszak = $this->modulidoszakRepository->find($id);

        if (empty($modulidoszak)) {
            return redirect(route('modulidoszaks.index'));
        }

        $modulidoszak = $this->modulidoszakRepository->update($request->all(), $id);

        return redirect(route('modulidoszaks.index'));
    }

    /**
     * Remove the specified Modulidoszak from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $modulidoszak = $this->modulidoszakRepository->find($id);

        if (empty($modulidoszak)) {
            return redirect(route('modulidoszaks.index'));
        }

        $this->modulidoszakRepository->delete($id);

        return redirect(route('modulidoszaks.index'));
    }
}
