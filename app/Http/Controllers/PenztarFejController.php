<?php

namespace App\Http\Controllers;

use App\Classes\MozgasClass;
use App\Http\Requests\CreatePenztarFejRequest;
use App\Http\Requests\UpdatePenztarFejRequest;
use App\Models\PenztarFej;
use App\Models\PenztarTetel;
use App\Models\RaktarKeszlet;
use App\Models\Termek;
use App\Repositories\PenztarFejRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Flash;
use Response;
use Carbon\Carbon;
use App\Models\Mozgasfej;
use App\Models\Mozgastetel;

class PenztarFejController extends AppBaseController
{
    /** @var  PenztarFejRepository */
    private $penztarFejRepository;

    public function __construct(PenztarFejRepository $penztarFejRepo)
    {
        $this->penztarFejRepository = $penztarFejRepo;
    }

    /**
     * Display a listing of the PenztarFej.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $penztarFejs = $this->penztarFejRepository->all();

        return view('penztar_fejs.index')
            ->with('penztarFejs', $penztarFejs);
    }

    public function kovetkezoBizonylatSzam()
    {
        $datum = Carbon::today()->toDateString();

        $bizonylatSzam = PenztarFej::whereDate('created_at', '=', $datum)->get()->max('bizonylatszam');
        if ( !empty($bizonylatSzam) ) {
            $eleje = substr( $bizonylatSzam, 0, 13);
            $vege = str_pad(strval(intval(substr($bizonylatSzam, -4)) + 1),4,"0",STR_PAD_LEFT);
            $bizonylatSzam = $eleje . $vege;
        }

        if ( empty($bizonylatSzam) ) {
            $bizonylatSzam = 'P-' . $datum . '-' . '0001';
        }

        return $bizonylatSzam;
    }

    public function penztarIndit()
    {
        $penztarFej = PenztarFej::create([
            'bizonylatszam' => $this->kovetkezoBizonylatSzam(),
            'ertek' => 0
        ]);
        return view('penztar_tetels.create')->with('penztarFej', $penztarFej);
    }

    public function mozgasFejCreate() {
        $mozgasFej = new Mozgasfej;
        $mozgasFej->mozgaskod_id = 2;
        $mozgasFej->datum = \Carbon\Carbon::now();
        $mozgasFej->partner = 2;
        $mozgasFej->bizszam = MozgasClass::kovetkezoBizszam(2);
        $mozgasFej->raktar = 2093;
        $mozgasFej->bf = 1;
        $mozgasFej->feldolgozott = 1;
        $mozgasFej->save();

        return $mozgasFej;
    }

    public function mozgasTetelCreate($mozgasFej, $penztarTetel) {
        $mozgasTetel = new Mozgastetel;
        $mozgasTetel->mozgasfej = $mozgasFej->id;
        $mozgasTetel->termek = $penztarTetel->termek_id;
        $mozgasTetel->mennyiseg =  $penztarTetel->darab;;
        $mozgasTetel->save();
    }

    public function raktarKeszletUpdate($penztarTetel) {
        $raktarkeszlet = RaktarKeszlet::where('raktar_id', 2093)->where('termek_id', $penztarTetel->termek_id)->first();
        if ( !empty($raktarkeszlet) ) {
            $raktarkeszlet->mennyiseg = $raktarkeszlet->mennyiseg - $penztarTetel->darab;
            $raktarkeszlet->save();
        }
    }

    public function penztarFejCreate() {
        $penztarFej = new PenztarFej;
        $penztarFej->bizonylatszam = $this->kovetkezoBizonylatSzam();
        $penztarFej->ertek = 0;
        $penztarFej->save();

        return $penztarFej;
    }

    public function termekUpdate($penztarTetel) {
        $termek = Termek::where('id', $penztarTetel->termek_id)->first();
        $termek->mennyiseg = $termek->mennyiseg - $penztarTetel->darab;
        $termek->save();
    }

    public function tetelFeladatok($mozgasFej, $penztarTetel) {
        /* ide kell a mozgasbizonylat tétel */
        $this->mozgasTetelCreate($mozgasFej, $penztarTetel);
        $this->raktarKeszletUpdate($penztarTetel);
        $this->termekUpdate($penztarTetel);
    }

    public function penztarKilep($id)
    {
        $penztarTetelek = PenztarTetel::where('penztarfej_id', $id)->get();


        if (PenztarTetel::where('penztarfej_id', $id)->count() === 0) {

            $penztarFej = PenztarFej::find($id);
            $penztarFej->delete();
            return redirect(route('home'));
        }
        if ( PenztarTetel::where('penztarfej_id', $id)->count() != 0) {
            /* ide kell a mozgasbizonylatfej */
            $mozgasFej = $this->mozgasFejCreate();

            foreach ( $penztarTetelek as $key => $penztarTetel) {

                /* ide kell a mozgasbizonylat tétel */
                $this->tetelFeladatok($mozgasFej, $penztarTetel);

            }
        }
        return redirect(route('home'));
    }

    public function penztarKovetkezo($id)
    {
        $penztarTetelek = PenztarTetel::where('penztarfej_id', $id)->get();
        if ( PenztarTetel::where('penztarfej_id', $id)->count() === 0) {
            Flash::error('Nincs tétel, nem zárható!')->important();
            $penztarFej = PenztarFej::find($id);
            return view('penztar_tetels.create')->with('penztarFej', $penztarFej);
        }
        if ( PenztarTetel::where('penztarfej_id', $id)->count() != 0) {
            /* ide kell a mozgasbizonylatfej */
            $mozgasFej = $this->mozgasFejCreate();

            foreach ( $penztarTetelek as $key => $penztarTetel) {

                /* ide kell a mozgasbizonylat tétel */
                $this->tetelFeladatok($mozgasFej, $penztarTetel);

            }
        }

        $penztarFej = $this->penztarFejCreate();

        return view('penztar_tetels.create')->with('penztarFej', $penztarFej);
    }

    /**
     * Show the form for creating a new PenztarFej.
     *
     * @return Response
     */
    public function create()
    {
        return view('penztar_fejs.create');
    }

    /**
     * Store a newly created PenztarFej in storage.
     *
     * @param CreatePenztarFejRequest $request
     *
     * @return Response
     */
    public function store(CreatePenztarFejRequest $request)
    {
        $input = $request->all();

        $penztarFej = $this->penztarFejRepository->create($input);

        Flash::success('Penztar Fej saved successfully.');

        return redirect(route('penztarFejs.index'));
    }

    /**
     * Display the specified PenztarFej.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $penztarFej = $this->penztarFejRepository->find($id);

        if (empty($penztarFej)) {
            Flash::error('Penztar Fej not found');

            return redirect(route('penztarFejs.index'));
        }

        return view('penztar_fejs.show')->with('penztarFej', $penztarFej);
    }

    /**
     * Show the form for editing the specified PenztarFej.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $penztarFej = $this->penztarFejRepository->find($id);

        if (empty($penztarFej)) {
            Flash::error('Penztar Fej not found');

            return redirect(route('penztarFejs.index'));
        }

        return view('penztar_fejs.edit')->with('penztarFej', $penztarFej);
    }

    /**
     * Update the specified PenztarFej in storage.
     *
     * @param int $id
     * @param UpdatePenztarFejRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePenztarFejRequest $request)
    {
        $penztarFej = $this->penztarFejRepository->find($id);

        if (empty($penztarFej)) {
            Flash::error('Penztar Fej not found');

            return redirect(route('penztarFejs.index'));
        }

        $penztarFej = $this->penztarFejRepository->update($request->all(), $id);

        Flash::success('Penztar Fej updated successfully.');

        return redirect(route('penztarFejs.index'));
    }

    /**
     * Remove the specified PenztarFej from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $penztarFej = $this->penztarFejRepository->find($id);

        if (empty($penztarFej)) {
            Flash::error('Penztar Fej not found');

            return redirect(route('penztarFejs.index'));
        }

        $this->penztarFejRepository->delete($id);

        Flash::success('Penztar Fej deleted successfully.');

        return redirect(route('penztarFejs.index'));
    }
}
