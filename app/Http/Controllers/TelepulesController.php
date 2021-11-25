<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTelepulesRequest;
use App\Http\Requests\UpdateTelepulesRequest;
use App\Repositories\TelepulesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

class TelepulesController extends AppBaseController
{
    /** @var  TelepulesRepository */
    private $telepulesRepository;

    public function __construct(TelepulesRepository $telepulesRepo)
    {
        $this->telepulesRepository = $telepulesRepo;
    }

    /**
     * Display a listing of the Telepules.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
      if( Auth::check() ){

        if ($request->ajax()) {

          $data = DB::table('telepules')
                      ->select('telepules.*')
                      ->whereNull('telepules.deleted_at')
                      ->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="' . route('telepules.edit', [$row->id]) . '"
                                   class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                        $btn = $btn.'<a href="' . route('TelepulesTorles', [$row->id]) . '"
                                   class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('telepules.index');

       }
       return view('auth.login');
    }
    /**
     * Show the form for creating a new Telepules.
     *
     * @return Response
     */
    public function create()
    {
        return view('telepules.create');
    }

    /**
     * Store a newly created Telepules in storage.
     *
     * @param CreateTelepulesRequest $request
     *
     * @return Response
     */
    public function store(CreateTelepulesRequest $request)
    {
        $input = $request->all();

        $telepules = $this->telepulesRepository->create($input);
        return redirect(route('telepules.index'));
    }

    /**
     * Display the specified Telepules.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $telepules = $this->telepulesRepository->find($id);

        if (empty($telepules)) {
            return redirect(route('telepules.index'));
        }

        return view('telepules.show')->with('telepules', $telepules);
    }

    /**
     * Show the form for editing the specified Telepules.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $telepules = $this->telepulesRepository->find($id);

        if (empty($telepules)) {
            return redirect(route('telepules.index'));
        }

        return view('telepules.edit')->with('telepules', $telepules);
    }

    /**
     * Update the specified Telepules in storage.
     *
     * @param int $id
     * @param UpdateTelepulesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTelepulesRequest $request)
    {
        $telepules = $this->telepulesRepository->find($id);

        if (empty($telepules)) {
            return redirect(route('telepules.index'));
        }

        $telepules = $this->telepulesRepository->update($request->all(), $id);
        return redirect(route('telepules.index'));
    }

    /**
     * Remove the specified Telepules from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $telepules = $this->telepulesRepository->find($id);

        if (empty($telepules)) {
            return redirect(route('telepules.index'));
        }

        $this->telepulesRepository->delete($id);
        return redirect(route('telepules.index'));
    }

    public function destroyMe($id)
    {
        $telepules = $this->telepulesRepository->find($id);

        if (empty($telepules)) {
            return redirect(route('telepules.index'));
        }

        $this->telepulesRepository->delete($id);
        return redirect(route('telepules.index'));
    }

}
