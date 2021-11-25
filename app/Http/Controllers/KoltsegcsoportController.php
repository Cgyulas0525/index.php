<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKoltsegcsoportRequest;
use App\Http\Requests\UpdateKoltsegcsoportRequest;
use App\Repositories\KoltsegcsoportRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

class KoltsegcsoportController extends AppBaseController
{
    /** @var  KoltsegcsoportRepository */
    private $koltsegcsoportRepository;

    public function __construct(KoltsegcsoportRepository $koltsegcsoportRepo)
    {
        $this->koltsegcsoportRepository = $koltsegcsoportRepo;
    }

    /**
     * Display a listing of the Koltsegcsoport.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

          if ($request->ajax()) {

              $data = DB::table('koltsegcsoport')
                            ->join('koltsegfocsoport AS p1', 'p1.id', 'koltsegcsoport.focsoport' )
                            ->select('koltsegcsoport.*', 'p1.nev as tnev')
                            ->whereNull('koltsegcsoport.deleted_at')
                            ->get();

              return Datatables::of($data)
                      ->addIndexColumn()
                      ->addColumn('action', function($row){
                          $btn = '<a href="' . route('koltsegcsoports.edit', [$row->id]) . '"
                                     class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                          $btn = $btn.'<a href="' . route('KtgCsoportTorles', [$row->id]) . '"
                                     class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                          return $btn;
                      })
                      ->rawColumns(['action'])
                      ->make(true);
          }

          return view('koltsegcsoports.index');

         }
         return view('auth.login');
    }

    /**
     * Show the form for creating a new Koltsegcsoport.
     *
     * @return Response
     */
    public function create()
    {
        return view('koltsegcsoports.create');
    }


    public function createMe($id)
    {
        return view('koltsegcsoports.createMe')->with('id', $id);
    }

    /**
     * Store a newly created Koltsegcsoport in storage.
     *
     * @param CreateKoltsegcsoportRequest $request
     *
     * @return Response
     */
    public function store(CreateKoltsegcsoportRequest $request)
    {
        $input = $request->all();

        $koltsegcsoport = $this->koltsegcsoportRepository->create($input);
        return view('koltsegcsoports.createMe')->with('id', $input['focsoport']);

    }

    /**
     * Display the specified Koltsegcsoport.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $koltsegcsoport = $this->koltsegcsoportRepository->find($id);

        if (empty($koltsegcsoport)) {
            return redirect(route('koltsegfocsoports.index'));
        }

        return view('koltsegcsoports.show')->with('koltsegcsoport', $koltsegcsoport);
    }

    /**
     * Show the form for editing the specified Koltsegcsoport.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $koltsegcsoport = $this->koltsegcsoportRepository->find($id);

        if (empty($koltsegcsoport)) {
            return redirect(route('koltsegfocsoports.index'));
        }

        return view('koltsegcsoports.edit')->with('koltsegcsoport', $koltsegcsoport);
    }

    /**
     * Update the specified Koltsegcsoport in storage.
     *
     * @param int $id
     * @param UpdateKoltsegcsoportRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKoltsegcsoportRequest $request)
    {
        $koltsegcsoport = $this->koltsegcsoportRepository->find($id);

        if (empty($koltsegcsoport)) {
            return redirect(route('koltsegfocsoports.index'));
        }

        $koltsegcsoport = $this->koltsegcsoportRepository->update($request->all(), $id);
        return redirect(route('koltsegfocsoports.index'));
    }

    /**
     * Remove the specified Koltsegcsoport from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $koltsegcsoport = $this->koltsegcsoportRepository->find($id);

        if (empty($koltsegcsoport)) {
            return redirect(route('koltsegfocsoports.index'));
        }

        $this->koltsegcsoportRepository->delete($id);
        return redirect(route('koltsegfocsoports.index'));
    }

    public function destroyMe($id)
    {
        $koltsegcsoport = $this->koltsegcsoportRepository->find($id);

        if (empty($koltsegcsoport)) {
            return redirect(route('koltsegfocsoports.index'));
        }

        $this->koltsegcsoportRepository->delete($id);
        return redirect(route('koltsegfocsoports.index'));
    }

}
