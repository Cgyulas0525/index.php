<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMegrendelestetelRequest;
use App\Http\Requests\UpdateMegrendelestetelRequest;
use App\Repositories\MegrendelestetelRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use DB;
use DataTables;
use App\Models\Termek;
use App\Models\Megrendelestetel;

class MegrendelestetelController extends AppBaseController
{
    /** @var  MegrendelestetelRepository */
    private $megrendelestetelRepository;

    public function __construct(MegrendelestetelRepository $megrendelestetelRepo)
    {
        $this->megrendelestetelRepository = $megrendelestetelRepo;
    }

    /**
     * Display a listing of the Megrendelestetel.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = DB::table('megrendelestetel')
                              ->join('termek AS p1', 'p1.id', 'megrendelestetel.termek' )
                              ->select('megrendelestetel.*', 'p1.nev as tnev')
                              ->whereNull('megrendelestetel.deleted_at')
                              ->get();

                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){
                            $btn = '<a href="' . route('megrendelestetels.edit', [$row->id]) . '"
                                       class="edit btn btn-success btn-sm editProduct" title="Módosítás"><i class="glyphicon glyphicon-edit"></i></a>';
                            $btn = $btn.'<a href="' . route('megrendelesTetelTorles', [$row->id]) . '"
                                       class="btn btn-danger btn-sm deleteProduct" title="Törlés"><i class="glyphicon glyphicon-trash"></i></a>';
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }

            return view('megrendelestetels.index');

           }
           return view('auth.login');
      }
    /**
     * Show the form for creating a new Megrendelestetel.
     *
     * @return Response
     */
    public function create($id)
    {
        return view('megrendelestetels.create')->with('id', $id);
    }

    /**
     * Store a newly created Megrendelestetel in storage.
     *
     * @param CreateMegrendelestetelRequest $request
     *
     * @return Response
     */
    public function store(CreateMegrendelestetelRequest $request)
    {
        $input = $request->all();
        $beszar = Termek::where('id', $input['termek'])->first()->beszar;
        $input['ertek'] = $beszar * $input['mennyiseg'];
        $megrendelestetel = $this->megrendelestetelRepository->create($input);
        return view('megrendelestetels.create')->with('id', $input['megrendelesfej']);
    }

    /**
     * Display the specified Megrendelestetel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $megrendelestetel = $this->megrendelestetelRepository->find($id);

        if (empty($megrendelestetel)) {
            return redirect(route('megrendelestetels.index'));
        }

        return view('megrendelestetels.show')->with('megrendelestetel', $megrendelestetel);
    }

    /**
     * Show the form for editing the specified Megrendelestetel.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $megrendelestetel = $this->megrendelestetelRepository->find($id);

        if (empty($megrendelestetel)) {
            return redirect(route('megrendelestetels.index'));
        }

        return view('megrendelestetels.edit')->with('megrendelestetel', $megrendelestetel);
    }

    /**
     * Update the specified Megrendelestetel in storage.
     *
     * @param int $id
     * @param UpdateMegrendelestetelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMegrendelestetelRequest $request)
    {
        $megrendelestetel = $this->megrendelestetelRepository->find($id);

        if (empty($megrendelestetel)) {
            return redirect(route('megrendelestetels.index'));
        }
        $input = $request->all();

        $beszar = Termek::where('id', $input['termek'])->first()->beszar;

        $megrendelestetel->mennyiseg = $input['mennyiseg'];
        $megrendelestetel->ertek = $beszar * $input['mennyiseg'];
        $megrendelestetel->save();

        return redirect(route('megrendelesfejs.edit', $megrendelestetel['megrendelesfej']));
    }

    /**
     * Remove the specified Megrendelestetel from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $megrendelestetel = $this->megrendelestetelRepository->find($id);

        if (empty($megrendelestetel)) {
            return redirect(route('megrendelestetels.index'));
        }

        $this->megrendelestetelRepository->delete($id);
        return redirect(route('megrendelestetels.index'));
    }

    public function torles($id)   // mint az edit
    {
        $megrendelestetel = $this->megrendelestetelRepository->find($id);

        if (empty($megrendelestetel)) {
            return redirect(route('megrendelesfejs.edit', $megrendelestetel['megrendelesfej']));
        }
        return view('megrendelestetels.torles')->with('megrendelestetel', $megrendelestetel);

    }

    public function destroyMe($id)
    {
        $megrendelestetel = $this->megrendelestetelRepository->find($id);
        if (empty($megrendelestetel)) {
            return redirect(route('megrendelesfejs.edit', $megrendelestetel['megrendelesfej']));
        }
        $this->megrendelestetelRepository->delete($id);
        return redirect(route('megrendelesfejs.edit', $megrendelestetel['megrendelesfej']));
    }

    public function indexFejId(Request $request, $id)
    {
        if( Auth::check() ){

            if ($request->ajax()) {

                $data = DB::table('megrendelestetel')
                    ->join('termek AS p1', 'p1.id', 'megrendelestetel.termek' )
                    ->select('megrendelestetel.*', 'p1.nev as tnev')
                    ->where('megrendelestetel.megrendelesfej', $id)
                    ->whereNull('megrendelestetel.deleted_at')
                    ->get();

                return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }

            return view('megrendelestetels.index');

        }
        return view('auth.login');
    }

}
