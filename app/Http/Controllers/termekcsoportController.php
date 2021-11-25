<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatetermekcsoportRequest;
use App\Http\Requests\UpdatetermekcsoportRequest;
use App\Models\Termekcsoport;
use App\Models\Termekfocsoport;
use App\Repositories\termekcsoportRepository;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Response;

class termekcsoportController extends AppBaseController
{
    /** @var  termekcsoportRepository */
    private $termekcsoportRepository;

    public function __construct(termekcsoportRepository $termekcsoportRepo)
    {
        $this->termekcsoportRepository = $termekcsoportRepo;
    }

    public function dtMake($data)
    {
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('tnev', function($data) { return $data->focsoportnev; })
            ->addColumn('afanev', function($data) { return $data->afanev; })
            ->addColumn('fokep', function($data) { return $data->fokep; })
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('termekcsoports.edit', [$row->id]) . '"
                                     class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                $btn = $btn.'<a href="' . route('TermekCsoportTorles', [$row->id]) . '"
                                     class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                $btn = $btn.'<a href="' . route('createFocsoportKep', [$row->id, 2110]) . '"
                                         class="btn btn-danger btn-sm deleteProduct" title="Kép"><i class="glyphicon glyphicon-picture"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Display a listing of the termekcsoport.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

          if ($request->ajax()) {

              $data = Termekcsoport::all();

              return $this->dtMake($data);

          }

          return view('termekcsoports.index');

         }
         return view('auth.login');
    }

    /**
     * Show the form for creating a new termekcsoport.
     *
     * @return Response
     */
    public function create()
    {
        return view('termekcsoports.create');
    }

    public function createMe($id)
    {
        $termekfocsoport = Termekfocsoport::find($id);
        return view('termekcsoports.createMe')->with('termekfocsoport', $termekfocsoport);
    }

    /**
     * Store a newly created termekcsoport in storage.
     *
     * @param CreatetermekcsoportRequest $request
     *
     * @return Response
     */
    public function store(CreatetermekcsoportRequest $request)
    {
        $input = $request->all();

        $termekcsoport = $this->termekcsoportRepository->create($input);
        return redirect(route('TermekCsoportInsert', $termekcsoport->focsoport));
    }

    /**
     * Display the specified termekcsoport.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $termekcsoport = $this->termekcsoportRepository->find($id);

        if (empty($termekcsoport)) {
            return redirect(route('termekcsoports.index'));
        }

        return view('termekcsoports.show')->with('termekcsoport', $termekcsoport);
    }

    /**
     * Show the form for editing the specified termekcsoport.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $termekcsoport = $this->termekcsoportRepository->find($id);

        if (empty($termekcsoport)) {
            return redirect(route('termekcsoports.index'));
        }

        return view('termekcsoports.edit')->with('termekcsoport', $termekcsoport);
    }

    /**
     * Update the specified termekcsoport in storage.
     *
     * @param int $id
     * @param UpdatetermekcsoportRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetermekcsoportRequest $request)
    {
        $termekcsoport = $this->termekcsoportRepository->find($id);

        if (empty($termekcsoport)) {
            return redirect(route('termekfocsoports.index'));
        }

        $termekcsoport = $this->termekcsoportRepository->update($request->all(), $id);
        return redirect(route('TermekCsoportInsert', $termekcsoport->focsoport));
    }

    /**
     * Remove the specified termekcsoport from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $termekcsoport = $this->termekcsoportRepository->find($id);

        if (empty($termekcsoport)) {
            return redirect(route('termekcsoports.index'));
        }

        $this->termekcsoportRepository->delete($id);
        return redirect(route('termekcsoports.index'));
    }

    public function destroyMe($id)
    {
        $termekcsoport = $this->termekcsoportRepository->find($id);

        if (empty($termekcsoport)) {
            return redirect(route('termekcsoports.index'));
        }

        $this->termekcsoportRepository->delete($id);
        return redirect(route('TermekCsoportInsert', $termekcsoport->focsoport));
    }

    /**
     * Display a listing of the termekcsoport.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexFocsoport(Request $request, $id)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Termekcsoport::where('focsoport', $id);

                return $this->dtMake($data);

            }

            return view('termekcsoports.index');

        }
        return view('auth.login');
    }


}
