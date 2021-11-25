<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKoltsegfocsoportRequest;
use App\Http\Requests\UpdateKoltsegfocsoportRequest;
use App\Repositories\KoltsegfocsoportRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

class KoltsegfocsoportController extends AppBaseController
{
    /** @var  KoltsegfocsoportRepository */
    private $koltsegfocsoportRepository;

    public function __construct(KoltsegfocsoportRepository $koltsegfocsoportRepo)
    {
        $this->koltsegfocsoportRepository = $koltsegfocsoportRepo;
    }

    /**
     * Display a listing of the Koltsegfocsoport.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

          if ($request->ajax()) {

            $data = DB::table('koltsegfocsoport')
                        ->select('koltsegfocsoport.*')
                        ->whereNull('koltsegfocsoport.deleted_at')
                        ->get();

              return Datatables::of($data)
                      ->addIndexColumn()
                      ->addColumn('action', function($row){
                          $btn = '<a href="' . route('koltsegfocsoports.edit', [$row->id]) . '"
                                     class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                          $btn = $btn.'<a href="' . route('KtgCsoportInsert', [$row->id]) . '"
                                  class="btn btn-warning btn-sm CsoportInsert" title="Költség csoport"><i class="glyphicon glyphicon-list-alt"></i></a>';
    /*                      $btn = $btn.'<a href="' . route('KtgFoCsoportTorles', [$row->id]) . '"
                                     class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';*/
                          return $btn;
                      })
                      ->rawColumns(['action'])
                      ->make(true);
          }

          return view('koltsegfocsoports.index');

         }
         return view('auth.login');
    }

    /**
     * Show the form for creating a new Koltsegfocsoport.
     *
     * @return Response
     */
    public function create()
    {
        return view('koltsegfocsoports.create');
    }

    /**
     * Store a newly created Koltsegfocsoport in storage.
     *
     * @param CreateKoltsegfocsoportRequest $request
     *
     * @return Response
     */
    public function store(CreateKoltsegfocsoportRequest $request)
    {
        $input = $request->all();

        $koltsegfocsoport = $this->koltsegfocsoportRepository->create($input);
        return redirect(route('koltsegfocsoports.index'));
    }

    /**
     * Display the specified Koltsegfocsoport.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $koltsegfocsoport = $this->koltsegfocsoportRepository->find($id);

        if (empty($koltsegfocsoport)) {
            return redirect(route('koltsegfocsoports.index'));
        }

        return view('koltsegfocsoports.show')->with('koltsegfocsoport', $koltsegfocsoport);
    }

    /**
     * Show the form for editing the specified Koltsegfocsoport.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $koltsegfocsoport = $this->koltsegfocsoportRepository->find($id);

        if (empty($koltsegfocsoport)) {
            return redirect(route('koltsegfocsoports.index'));
        }

        return view('koltsegfocsoports.edit')->with('koltsegfocsoport', $koltsegfocsoport);
    }

    /**
     * Update the specified Koltsegfocsoport in storage.
     *
     * @param int $id
     * @param UpdateKoltsegfocsoportRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKoltsegfocsoportRequest $request)
    {
        $koltsegfocsoport = $this->koltsegfocsoportRepository->find($id);

        if (empty($koltsegfocsoport)) {
            return redirect(route('koltsegfocsoports.index'));
        }

        $koltsegfocsoport = $this->koltsegfocsoportRepository->update($request->all(), $id);
        return redirect(route('koltsegfocsoports.index'));
    }

    /**
     * Remove the specified Koltsegfocsoport from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $koltsegfocsoport = $this->koltsegfocsoportRepository->find($id);

        if (empty($koltsegfocsoport)) {
            return redirect(route('koltsegfocsoports.index'));
        }

        $this->koltsegfocsoportRepository->delete($id);
        return redirect(route('koltsegfocsoports.index'));
    }

    public function destroyMe($id)
    {
        $koltsegfocsoport = $this->koltsegfocsoportRepository->find($id);

        if (empty($koltsegfocsoport)) {
            return redirect(route('koltsegfocsoports.index'));
        }

        $this->koltsegfocsoportRepository->delete($id);
        return redirect(route('koltsegfocsoports.index'));
    }
}
