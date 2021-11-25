<?php
namespace App\Http\Controllers;

use App\Http\Requests\CreateMozgastetelRequest;
use App\Http\Requests\UpdateMozgastetelRequest;
use App\Repositories\MozgastetelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;

use App\Models\Mozgasfej;
use App\Models\Mozgastetel;
use App\Models\Termek;

class MozgastetelController extends AppBaseController
{
    /** @var  MozgastetelRepository */
    private $mozgastetelRepository;

    public function __construct(MozgastetelRepository $mozgastetelRepo)
    {
        $this->mozgastetelRepository = $mozgastetelRepo;
    }

    private function dataView( $data ) {
        return Datatables::of($data)
            ->addColumn('tnev', function($data) { return $data->termeknev; })
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="' . route('mozgastetels.edit', [$row->id]) . '"
                                     class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                $btn = $btn.'<a href="' . route('MTT', [$row->id]) . '"
                                     class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Display a listing of the Mozgastetel.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

          if ($request->ajax()) {

              $data = Mozgastetel::all();
              return $this->dataView($data);

          }

          return view('mozgastetels.index');

         }
         return view('auth.login');
    }

    /**
     * Display a listing of the Mozgastetel.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexTetel(Request $request, $id)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Mozgastetel::where('mozgasfej', $id)->get();
                return $this->dataView($data);

            }

            return view('mozgastetels.index');

        }
        return view('auth.login');
    }

    /**
     * Display a listing of the Mozgastetel.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function indexFejId(Request $request, $id)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = Mozgastetel::where('mogasfej', $id)->get();
                return $this->dataView($data);

            }

            return view('mozgastetels.index');

        }
        return view('auth.login');
    }

    /**
     * Show the form for creating a new Mozgastetel.
     *
     * @return Response
     */
    public function create()
    {
        return view('mozgastetels.create');
    }

    public function createFelhasznalas($id)
    {
        return view('mozgastetels.createFelhasznalas')->with('id', $id);;
    }

    public function createMe($id)
    {
        $mozgasFej = Mozgasfej::find($id);

        if ( $mozgasFej->feldolgozott == 1 ) {

            Flash::error('Már bevételezte a bizonylatot. Nem vehet fel új tételt!')->important();

            return view('mozgasfejs.index');
        }

        return view('mozgastetels.createMe')->with('mozgasFej', $mozgasFej);
    }

    /**
     * Store a newly created Mozgastetel in storage.
     *
     * @param CreateMozgastetelRequest $request
     *
     * @return Response
     */


    public function store(CreateMozgastetelRequest $request)
    {
        $input = $request->all();

        if ( !empty($input['termek_nev']) ) {
            $termek = Termek::create([
                'nev' => $input['termek_nev'],
                'csoport' => $input['termek_csoport'],
                'partner' => $input['termek_partner'],
                'cikkszam' => $input['termek_cikkszam'],
                'barcode' => $input['barcode'],
                'me' => $input['termek_me'],
                'minmenny' => $input['termek_minmenny'],
                'mennyiseg' => $input['termek_mennyiseg'],
                'beszar' => $input['termek_beszar'],
                'ar' => $input['termek_ar']
            ]);
            $input['termek'] = $termek->id;
        }

        $mozgastetel = $this->mozgastetelRepository->create($input);

        $mozgasFej = Mozgasfej::find($input['mozgasfej']);

        return view('mozgastetels.createMe')->with('mozgasFej', $mozgasFej);
    }

    /**
     * Display the specified Mozgastetel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $mozgastetel = $this->mozgastetelRepository->find($id);

        if (empty($mozgastetel)) {
            Flash::error('Mozgastetel not found');

            return redirect(route('mozgastetels.index'));
        }

        return view('mozgastetels.show')->with('mozgastetel', $mozgastetel);
    }

    /**
     * Show the form for editing the specified Mozgastetel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $mozgastetel = $this->mozgastetelRepository->find($id);

        if (empty($mozgastetel)) {
            Flash::error('Mozgastetel not found');

            return redirect(route('mozgastetels.index'));
        }

        return view('mozgastetels.edit')->with('mozgastetel', $mozgastetel);
    }

    /**
     * Update the specified Mozgastetel in storage.
     *
     * @param int $id
     * @param UpdateMozgastetelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMozgastetelRequest $request)
    {
        $mozgastetel = $this->mozgastetelRepository->find($id);

        if (empty($mozgastetel)) {

                return redirect(route('mozgasfejs.edit', $mozgastetel['mozgasfej']));
        }

        $input = $request->all();

        $mozgastetel->mennyiseg = $input["mennyiseg"];

        $mozgastetel->save();

        return redirect(route('mozgasfejs.edit', $mozgastetel['mozgasfej']));
    }

    public function felhasznalasTetelUpdate($id, UpdateMozgastetelRequest $request)
    {
        $mozgastetel = $this->mozgastetelRepository->find($id);

        if (empty($mozgastetel)) {
            return redirect(route('felhasznalasEdit', $mozgastetel->mozgasfej));
        }

        $mozgastetel = $this->mozgastetelRepository->update($request->all(), $id);
        return redirect(route('felhasznalasEdit', $mozgastetel->mozgasfej));
    }

    /**
     * Remove the specified Mozgastetel from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $mozgastetel = $this->mozgastetelRepository->find($id);

        if (empty($mozgastetel)) {
            return redirect(route('mozgastetels.index'));
        }

        $this->mozgastetelRepository->delete($id);

        Flash::success('Mozgastetel deleted successfully.');

        return redirect(route('mozgastetels.index'));
    }

    public function destroyMe($id)
    {
        $mozgastetel = $this->mozgastetelRepository->find($id);
        if ( empty($mozgastetel) ) {
            return redirect(route('mozgasfejs.edit', $mozgastetel['mozgasfej']));
        }

        $this->mozgastetelRepository->delete($id);

        return redirect(route('mozgasfejs.edit', $mozgastetel['mozgasfej']));
    }

    public function torles($id)   // mint az edit
    {
        $mozgastetel = $this->mozgastetelRepository->find($id);

        if (empty($mozgastetel)) {
            return redirect(route('mozgasfejs.edit', $mozgastetel['mozgasfej']));
        }
        return view('mozgastetels.torles')->with('mozgastetel', $mozgastetel);

    }

    public function tetelindex(Request $request, $id)
    {
        if( Auth::check() ){

          if ($request->ajax()) {

              $data = Mozgastetel::where('mozgasfej', $id)->get();

              return Datatables::of($data)
                        ->addColumn('termeknev', function($data) { return $data->termeknev; })
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                          $btn = '<a href="' . route('mozgastetels.edit', [$row->id]) . '"
                                     class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                          $btn = $btn.'<a href="' . route('MTT', [$row->id]) . '"
                                     class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                          return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
          }

          return view('mozgastetels.index');

         }
         return view('auth.login');
    }
}
