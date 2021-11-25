<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateModulRequest;
use App\Http\Requests\UpdateModulRequest;
use App\Models\Lista;
use App\Repositories\ModulRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

use App\Models\Modul;

class ModulController extends AppBaseController
{
    /** @var  ModulRepository */
    private $modulRepository;

    public function __construct(ModulRepository $modulRepo)
    {
        $this->modulRepository = $modulRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('listadarab', function($data) { return $data->listadarab; })
            ->addColumn('idoszakdarab', function($data) { return $data->idoszakdarab; })
            ->addColumn('szurodarab', function($data) { return $data->szurodarab; })
            ->addColumn('action', function($row){
                  $btn = '<a href="' . route('moduls.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                  $btn = $btn.'<a href="' . route('moduls.destroy', [$row->id]) . '"
                             class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                  return $btn;
              })
              ->rawColumns(['action'])
              ->make(true);
    }


    /**
     * Display a listing of the Modul.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Modul::all();
                return $this->dwData($data);

            }

            return view('moduls.index');
        }
    }

    /**
     * Show the form for creating a new Modul.
     *
     * @return Response
     */
    public function create()
    {
        return view('moduls.create');
    }

    /**
     * Store a newly created Modul in storage.
     *
     * @param CreateModulRequest $request
     *
     * @return Response
     */
    public function store(CreateModulRequest $request)
    {
        $input = $request->all();

        $modul = $this->modulRepository->create($input);

        return redirect(route('moduls.index'));
    }

    /**
     * Display the specified Modul.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $modul = $this->modulRepository->find($id);

        if (empty($modul)) {
            return redirect(route('moduls.index'));
        }

        return view('moduls.show')->with('modul', $modul);
    }

    /**
     * Show the form for editing the specified Modul.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $modul = $this->modulRepository->find($id);

        if (empty($modul)) {
            return redirect(route('moduls.index'));
        }

        return view('moduls.edit')->with('modul', $modul);
    }

    /**
     * Update the specified Modul in storage.
     *
     * @param int $id
     * @param UpdateModulRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateModulRequest $request)
    {
        $modul = $this->modulRepository->find($id);

        if (empty($modul)) {
            return redirect(route('moduls.index'));
        }

        $modul = $this->modulRepository->update($request->all(), $id);

        return redirect(route('moduls.index'));
    }

    /**
     * Remove the specified Modul from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $darab = Lista::where('modul_id', $id)->count();

        if ($darab === 0) {
            Flash::error('Nem törölhető tétel!')->important();
            return redirect(route('moduls.index'));
        }

        $modul = $this->modulRepository->find($id);

        if (empty($modul)) {
            return redirect(route('moduls.index'));
        }

        $this->modulRepository->delete($id);

        return redirect(route('moduls.index'));
    }
}
