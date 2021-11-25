<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Repositories\TypeRepository;
use Auth;
use DataTables;
use DB;
use Flash;
use Illuminate\Http\Request;
use Response;

class TypeController extends AppBaseController
{
    /** @var  TypeRepository */
    private $typeRepository;

    public function __construct(TypeRepository $typeRepo)
    {
        $this->typeRepository = $typeRepo;
    }

    /**
     * Display a listing of the Type.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        if( Auth::check() ){

          if ($request->ajax()) {

            $data = DB::table('types')
                          ->select('types.*')
                          ->whereNull('types.deleted_at')
                          ->get();

                return Datatables::of($data)
                      ->addIndexColumn()
                      ->addColumn('action', function($row){

                        $btn = '<a href="' . route('TipusEdit', [$row->id]) . '"
                                 class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                        $btn = $btn.'<a href="' . route('TipusTorles', [$row->id]) . '"
                                class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                        return $btn;
                      })
                      ->rawColumns(['action'])
                      ->make(true);
          }

          return view('types.index');

         }
         return view('auth.login');
    }

    /**
     * Show the form for creating a new Type.
     *
     * @return Response
     */
    public function create()
    {
        return view('types.create');
    }

    /**
     * Store a newly created Type in storage.
     *
     * @param CreateTypeRequest $request
     *
     * @return Response
     */
    public function store(CreateTypeRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;

        $type = $this->typeRepository->create($input);
        return redirect(route('types.create'));
    }

    /**
     * Display the specified Type.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $type = $this->typeRepository->find($id);

        if (empty($type)) {
            return redirect(route('types.index'));
        }

        return view('types.show')->with('type', $type);
    }

    /**
     * Show the form for editing the specified Type.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $type = $this->typeRepository->find($id);

        if (empty($type)) {
            return redirect(route('types.index'));
        }

        return view('types.edit')->with('type', $type);
    }

    /**
     * Update the specified Type in storage.
     *
     * @param int $id
     * @param UpdateTypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTypeRequest $request)
    {
        $type = $this->typeRepository->find($id);

        if (empty($type)) {
            return redirect(route('types.index'));
        }

        $type = $this->typeRepository->update($request->all(), $id);
        return redirect(route('types.index'));
    }

    /**
     * Remove the specified Type from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $type = $this->typeRepository->find($id);

        if (empty($type)) {
            return redirect(route('types.index'));
        }

        $this->typeRepository->delete($id);
        return redirect(route('types.index'));
    }

    public function destroyMe($id)
    {
        $db = DB::table('dictionaries')->where('tipus', '=', $id)->whereNull('deleted_at')->count();
        if ($db ==  0){
            $type = $this->typeRepository->find($id);

            if (empty($type)) {
                return redirect(route('types.index'));
            }

            $this->typeRepository->delete($id);
        }else{
            Flash::error('Nem törölhető a tétel!');
        }
        return redirect(route('types.index'));
    }
}
