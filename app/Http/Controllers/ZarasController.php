<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateZarasRequest;
use App\Http\Requests\UpdateZarasRequest;
use App\Repositories\ZarasRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;
use App\Models\Zaras;
use App\Classes\ZarasClass;

class ZarasController extends AppBaseController
{
    /** @var  ZarasRepository */
    private $zarasRepository;

    public function __construct(ZarasRepository $zarasRepo)
    {
        $this->zarasRepository = $zarasRepo;
    }

    /**
     * Display a listing of the Zaras.
     *
     * @param Request $request
     *
     * @return Response
     */
     public function index(Request $request)
     {
       if( Auth::check() ){

         if ($request->ajax()) {

           $data = Zaras::all();

             return Datatables::of($data)
                     ->addIndexColumn()
                     ->addColumn('sum', function($data) { return $data->osszeg; })
                     ->addColumn('nev', function($data) { return $data->napnev; })
                     ->addColumn('action', function($row){
                         $btn = '<a href="' . route('zaras.edit', [$row->id]) . '"
                                    class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                         $btn = $btn.'<a href="' . route('ZarasTorles', [$row->id]) . '"
                                    class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                         return $btn;
                     })
                     ->rawColumns(['action'])
                     ->make(true);
         }

         return view('zaras.index');

        }
        return view('auth.login');
     }

    /**
     * Show the form for creating a new Zaras.
     *
     * @return Response
     */
    public function create()
    {
        return view('zaras.create');
    }

    /**
     * Store a newly created Zaras in storage.
     *
     * @param CreateZarasRequest $request
     *
     * @return Response
     */
    public function store(CreateZarasRequest $request)
    {
        $input = $request->all();
        $zaras = $this->zarasRepository->create($input);
        return redirect(route('zaras.index'));
    }

    /**
     * Display the specified Zaras.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $zaras = $this->zarasRepository->find($id);

        if (empty($zaras)) {
            return redirect(route('zaras.index'));
        }
        return view('zaras.show')->with('zaras', $zaras);
    }

    /**
     * Show the form for editing the specified Zaras.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $zaras = $this->zarasRepository->find($id);

        if (empty($zaras)) {
            return redirect(route('zaras.index'));
        }

        return view('zaras.edit')->with('zaras', $zaras);
    }

    /**
     * Update the specified Zaras in storage.
     *
     * @param int $id
     * @param UpdateZarasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateZarasRequest $request)
    {
        $zaras = $this->zarasRepository->find($id);

        if (empty($zaras)) {
            return redirect(route('zaras.index'));
        }

        $zaras = $this->zarasRepository->update($request->all(), $id);
        return redirect(route('zaras.index'));
    }

    /**
     * Remove the specified Zaras from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $zaras = $this->zarasRepository->find($id);

        if (empty($zaras)) {
            return redirect(route('zaras.index'));
        }

        $this->zarasRepository->delete($id);
        return redirect(route('zaras.index'));
    }

    public function destroyMe($id)
    {
        $zaras = $this->zarasRepository->find($id);

        if (empty($zaras)) {
            return redirect(route('zaras.index'));
        }

        $this->zarasRepository->delete($id);
        return redirect(route('zaras.index'));
    }
    
    public function atlagNapi(Request $request)
    {
      if( Auth::check() ){

        if ($request->ajax()) {

          $data =  ZarasClass::atlagNapiArbevetelMegoszlas();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
        }

        return view('zaras.index');

       }
       return view('auth.login');
    }

}
