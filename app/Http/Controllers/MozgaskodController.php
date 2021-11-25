<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMozgaskodRequest;
use App\Http\Requests\UpdateMozgaskodRequest;
use App\Repositories\MozgaskodRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

use App\Models\Mozgaskod;

class MozgaskodController extends AppBaseController
{
    /** @var  MozgaskodRepository */
    private $mozgaskodRepository;

    public function __construct(MozgaskodRepository $mozgaskodRepo)
    {
        $this->mozgaskodRepository = $mozgaskodRepo;
    }

    /**
     * Display a listing of the Mozgaskod.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

          if ($request->ajax()) {

            $data = Mozgaskod::all();


            return Datatables::of($data)
                      ->addIndexColumn()
                      ->addColumn('honnannev', function($data) { return $data->honnannev; })
                      ->addColumn('hovanev', function($data) { return $data->hovanev; })
                      ->addColumn('pmnev', function($data) { return $data->pmnev; })
                      ->addColumn('action', function($row){
                            $btn = '<a href="' . route('mozgaskods.edit', [$row->id]) . '"
                                    class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                            $btn = $btn.'<a href="' . route('mozgaskods.destroy', [$row->id]) . '"
                                    class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                        return $btn;
                      })
                      ->rawColumns(['action'])
                      ->make(true);
          }

          return view('mozgaskods.index');

         }
         return view('auth.login');
    }

    /**
     * Show the form for creating a new Mozgaskod.
     *
     * @return Response
     */
    public function create()
    {
        return view('mozgaskods.create');
    }

    /**
     * Store a newly created Mozgaskod in storage.
     *
     * @param CreateMozgaskodRequest $request
     *
     * @return Response
     */
    public function store(CreateMozgaskodRequest $request)
    {
        $input = $request->all();

        $mozgaskod = $this->mozgaskodRepository->create($input);

        return redirect(route('mozgaskods.create'));
    }

    /**
     * Display the specified Mozgaskod.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mozgaskod = $this->mozgaskodRepository->find($id);

        if (empty($mozgaskod)) {

            return redirect(route('mozgaskods.index'));
        }

        return view('mozgaskods.show')->with('mozgaskod', $mozgaskod);
    }

    /**
     * Show the form for editing the specified Mozgaskod.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $mozgaskod = $this->mozgaskodRepository->find($id);

        if (empty($mozgaskod)) {

            return redirect(route('mozgaskods.index'));
        }

        return view('mozgaskods.edit')->with('mozgaskod', $mozgaskod);
    }

    /**
     * Update the specified Mozgaskod in storage.
     *
     * @param int $id
     * @param UpdateMozgaskodRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMozgaskodRequest $request)
    {
        $mozgaskod = $this->mozgaskodRepository->find($id);

        if (empty($mozgaskod)) {

            return redirect(route('mozgaskods.index'));
        }

        $mozgaskod = $this->mozgaskodRepository->update($request->all(), $id);

        return redirect(route('mozgaskods.index'));
    }

    /**
     * Remove the specified Mozgaskod from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mozgaskod = $this->mozgaskodRepository->find($id);

        if (empty($mozgaskod)) {

            return redirect(route('mozgaskods.index'));
        }

        $this->mozgaskodRepository->delete($id);

        return redirect(route('mozgaskods.index'));
    }
}
