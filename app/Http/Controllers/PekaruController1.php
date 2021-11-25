<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatetermekRequest;
use App\Http\Requests\UpdatetermekRequest;
use App\Repositories\termekRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;
use App\Models\termek;

class PekaruController extends AppBaseController
{
    /** @var  termekRepository */
    private $termekRepository;

    public function __construct(termekRepository $termekRepo)
    {
        $this->termekRepository = $termekRepo;
    }

    /**
     * Display a listing of the termek.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
      if( Auth::check() ){

        if ($request->ajax()) {

            $data = termek::getPekaru();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="' . route('pekaru.edit', [$row->id]) . '"
                                   class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('pekaru.index');

       }
       return view('auth.login');
    }

    /**
     * Show the form for creating a new termek.
     *
     * @return Response
     */
    public function create()
    {
        return view('termeks.create');
    }

    /**
     * Store a newly created termek in storage.
     *
     * @param CreatetermekRequest $request
     *
     * @return Response
     */
    public function store(CreatetermekRequest $request)
    {
        $input = $request->all();

        $termek = $this->termekRepository->create($input);
        return redirect(route('termeks.create'));
    }

    /**
     * Display the specified termek.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $termek = $this->termekRepository->find($id);

        if (empty($termek)) {
            return redirect(route('termeks.index'));
        }

        return view('termeks.show')->with('termek', $termek);
    }

    /**
     * Show the form for editing the specified termek.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $termek = $this->termekRepository->find($id);

        if (empty($termek)) {
            return redirect(route('pekaru.index'));
        }

        return view('pekaru.edit')->with('termek', $termek);
    }

    /**
     * Update the specified termek in storage.
     *
     * @param int $id
     * @param UpdatetermekRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetermekRequest $request)
    {
        $termek = $this->termekRepository->find($id);

        if (empty($termek)) {
            return redirect(route('pekaru.index'));
        }

        $termek = $this->termekRepository->update($request->all(), $id);
        return redirect(route('pekaru.index'));
    }

    /**
     * Remove the specified termek from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $termek = $this->termekRepository->find($id);

        if (empty($termek)) {
            return redirect(route('termeks.index'));
        }

        $this->termekRepository->delete($id);
        return redirect(route('termeks.index'));
    }

    public function destroyMe($id)
    {
        $termek = $this->termekRepository->find($id);

        if (empty($termek)) {
            return redirect(route('termeks.index'));
        }

        $this->termekRepository->delete($id);
        return redirect(route('termeks.index'));
    }

    public function minKeszlet(Request $request)
    {

      if( Auth::check() ){

          if ($request->ajax()) {

              $data = termek::getPekaruMinKeszlet();

              return Datatables::of($data)
                      ->addIndexColumn()
                      ->addColumn('action', function($row){
                          $btn = '<a href="' . route('pekaru.edit', [$row->id]) . '"
                                     class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                          return $btn;
                      })
                      ->rawColumns(['action'])
                      ->make(true);
          }

          return view('pekaru.minkeszlet');
       }
       return view('auth.login');
    }

}
