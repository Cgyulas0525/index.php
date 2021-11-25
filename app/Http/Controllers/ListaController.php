<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateListaRequest;
use App\Http\Requests\UpdateListaRequest;
use App\Repositories\ListaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

use App\Models\Lista;

class ListaController extends AppBaseController
{
    /** @var  ListaRepository */
    private $listaRepository;

    public function __construct(ListaRepository $listaRepo)
    {
        $this->listaRepository = $listaRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
              ->addIndexColumn()
            ->addColumn('modulnev', function($data) { return $data->modulnev; })
            ->addColumn('action', function($row){
                  $btn = '<a href="' . route('listas.edit', [$row->id]) . '"
                             class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                  $btn = $btn.'<a href="' . route('listas.destroy', [$row->id]) . '"
                             class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                  return $btn;
              })
              ->rawColumns(['action'])
              ->make(true);
    }


    /**
     * Display a listing of the Lista.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Lista::all();
                return $this->dwData($data);

            }

            return view('listas.index');
        }
    }

    /**
     * Show the form for creating a new Lista.
     *
     * @return Response
     */
    public function create()
    {
        return view('listas.create');
    }

    /**
     * Store a newly created Lista in storage.
     *
     * @param CreateListaRequest $request
     *
     * @return Response
     */
    public function store(CreateListaRequest $request)
    {
        $input = $request->all();

        $lista = $this->listaRepository->create($input);

        return redirect(route('listas.index'));
    }

    /**
     * Display the specified Lista.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $lista = $this->listaRepository->find($id);

        if (empty($lista)) {
            return redirect(route('listas.index'));
        }

        return view('listas.show')->with('lista', $lista);
    }

    /**
     * Show the form for editing the specified Lista.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $lista = $this->listaRepository->find($id);

        if (empty($lista)) {
            return redirect(route('listas.index'));
        }

        return view('listas.edit')->with('lista', $lista);
    }

    /**
     * Update the specified Lista in storage.
     *
     * @param int $id
     * @param UpdateListaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateListaRequest $request)
    {
        $lista = $this->listaRepository->find($id);

        if (empty($lista)) {
            return redirect(route('listas.index'));
        }

        $lista = $this->listaRepository->update($request->all(), $id);

        return redirect(route('listas.index'));
    }

    /**
     * Remove the specified Lista from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $lista = $this->listaRepository->find($id);

        if (empty($lista)) {
            return redirect(route('listas.index'));
        }

        $this->listaRepository->delete($id);

        return redirect(route('listas.index'));
    }
}
