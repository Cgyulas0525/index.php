<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateModulszuroRequest;
use App\Http\Requests\UpdateModulszuroRequest;
use App\Repositories\ModulszuroRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

use App\Models\Modulszuro;

class ModulszuroController extends AppBaseController
{
    /** @var  ModulszuroRepository */
    private $modulszuroRepository;

    public function __construct(ModulszuroRepository $modulszuroRepo)
    {
        $this->modulszuroRepository = $modulszuroRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('modulnev', function($data) { return $data->modulnev; })
              ->addColumn('action', function($row){
                  $btn = '<a href="' . route('modulszuros.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                  $btn = $btn.'<a href="' . route('modulszuros.destroy', [$row->id]) . '"
                             class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                  return $btn;
              })
              ->rawColumns(['action'])
              ->make(true);
    }


    /**
     * Display a listing of the Modulszuro.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Modulszuro::all();
                return $this->dwData($data);

            }

            return view('modulszuros.index');
        }
    }

    /**
     * Show the form for creating a new Modulszuro.
     *
     * @return Response
     */
    public function create()
    {
        return view('modulszuros.create');
    }

    /**
     * Store a newly created Modulszuro in storage.
     *
     * @param CreateModulszuroRequest $request
     *
     * @return Response
     */
    public function store(CreateModulszuroRequest $request)
    {
        $input = $request->all();

        $modulszuro = $this->modulszuroRepository->create($input);

        return redirect(route('modulszuros.index'));
    }

    /**
     * Display the specified Modulszuro.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $modulszuro = $this->modulszuroRepository->find($id);

        if (empty($modulszuro)) {
            return redirect(route('modulszuros.index'));
        }

        return view('modulszuros.show')->with('modulszuro', $modulszuro);
    }

    /**
     * Show the form for editing the specified Modulszuro.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $modulszuro = $this->modulszuroRepository->find($id);

        if (empty($modulszuro)) {
            return redirect(route('modulszuros.index'));
        }

        return view('modulszuros.edit')->with('modulszuro', $modulszuro);
    }

    /**
     * Update the specified Modulszuro in storage.
     *
     * @param int $id
     * @param UpdateModulszuroRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateModulszuroRequest $request)
    {
        $modulszuro = $this->modulszuroRepository->find($id);

        if (empty($modulszuro)) {
            return redirect(route('modulszuros.index'));
        }

        $modulszuro = $this->modulszuroRepository->update($request->all(), $id);

        return redirect(route('modulszuros.index'));
    }

    /**
     * Remove the specified Modulszuro from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $modulszuro = $this->modulszuroRepository->find($id);

        if (empty($modulszuro)) {
            return redirect(route('modulszuros.index'));
        }

        $this->modulszuroRepository->delete($id);

        return redirect(route('modulszuros.index'));
    }
}
