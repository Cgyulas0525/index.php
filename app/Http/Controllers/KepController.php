<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateKepRequest;
use App\Http\Requests\UpdateKepRequest;
use App\Models\Termekfocsoport;
use App\Models\Termekcsoport;
use App\Models\Termek;
use App\Repositories\KepRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

use App\Models\Kep;

class KepController extends AppBaseController
{
    /** @var  KepRepository */
    private $kepRepository;

    public function __construct(KepRepository $kepRepo)
    {
        $this->kepRepository = $kepRepo;
    }

    public function dwData($data)
    {
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('parentnev', function($data) { return $data->parentnev; })
                ->addColumn('action', function($row){
                      $btn = '<a href="' . route('keps.edit', [$row->id]) . '"
                                 class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                      $btn = $btn.'<a href="' . route('keps.destroy', [$row->id]) . '"
                                 class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                      return $btn;
                  })
                  ->rawColumns(['action'])
                  ->make(true);
    }


    /**
     * Display a listing of the Kep.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Kep::all();
                return $this->dwData($data);

            }

            return view('keps.index');
        }
    }

    /**
     * Display a listing of the Kep.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexParent(Request $request, $id, $melyik)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Kep::where('parent_id', $id)->where('dictionary_id', $melyik)->get();
                return $this->dwData($data);

            }

            return view('keps.index');
        }
    }

    /**
     * Show the form for creating a new Kep.
     *
     * @return Response
     */
    public function create()
    {
        return view('keps.create');
    }

    public function createFocsoportKep($id, $melyik)
    {
        if ($melyik == 2109) {
            $focsoport = Termekfocsoport::find($id);
        }
        if ($melyik == 2110) {
            $focsoport = Termekcsoport::find($id);
        }
        if ($melyik == 2111) {
            $focsoport = Termek::find($id);
        }
        return view('keps.createFocsoportKep', ['focsoport' => $focsoport, 'melyik' => $melyik]);
    }

    public function createCsoportKep($id)
    {
        $focsoport = Termekcsoport::find($id);
        return view('keps.createCsoportKep')->with('focsoport', $focsoport);
    }


    /**
     * Store a newly created Kep in storage.
     *
     * @param CreateKepRequest $request
     *
     * @return Response
     */
    public function store(CreateKepRequest $request)
    {
        $input = $request->all();

        if ($request->fokep == '1') {
            if ( Kep::where('parent_id', $request->parent_id)->where('dictionary_id', $request->dictionary_id)->where('fokep', 1)->count() > 0) {
                Flash::error('Már van másik hozzárendelt főkép!')->important();
                return back();
            }
        }

        $file = $request->file('image_url');

        if (!empty($file)){

            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();

            $path = 'upload/'.uniqid().'.'.$extension;
            $img = Image::make($file);
            $img->save(public_path($path));
            $kicsipath = 'upload/kicsi/'.uniqid().'.'.$extension;
            $img = Image::make($file)->resize(40,40);
            $img->save(public_path($kicsipath));
            $input['kep'] = 'public/'.$path;
            $input['kicsikep'] = 'public/'.$kicsipath;
        }

        $kep = $this->kepRepository->create($input);

        if (empty($request->fokep)) {
            $kep->fokep = 0;
            $kep->save();
        };

        return back();
    }

    /**
     * Display the specified Kep.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $kep = $this->kepRepository->find($id);

        if (empty($kep)) {
            return redirect(route('keps.index'));
        }

        return view('keps.show')->with('kep', $kep);
    }

    /**
     * Show the form for editing the specified Kep.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $kep = $this->kepRepository->find($id);

        if (empty($kep)) {
            return redirect(route('keps.index'));
        }

        return view('keps.edit')->with('kep', $kep);
    }

    /**
     * Update the specified Kep in storage.
     *
     * @param int $id
     * @param UpdateKepRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKepRequest $request)
    {
        $kep = $this->kepRepository->find($id);

        if ($request->fokep == '1') {
            if ( Kep::where('parent_id', $kep->parent_id)->where('dictionary_id', $request->dictionary_id)->where('id', '<>', $id)->where('fokep', 1)->count() > 0) {
                Flash::error('Már van másik hozzárendelt főkép!')->important();
                return back();
            }
        }


        if (empty($kep)) {
            return redirect(route('createFocsoportKep', [$kep->parent_id, $kep->dictionary_id]));
        }

        $kep = $this->kepRepository->update($request->all(), $id);

        if (empty($request->fokep)) {
            $kep->fokep = 0;
            $kep->save();
        };

        return redirect(route('createFocsoportKep', [$kep->parent_id, $kep->dictionary_id]));
    }

    /**
     * Remove the specified Kep from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $kep = $this->kepRepository->find($id);

        if (empty($kep)) {
            return redirect(route('keps.index'));
        }

        $this->kepRepository->delete($id);

        return redirect(route('keps.index'));
    }
}
