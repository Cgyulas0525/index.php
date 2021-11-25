<?php

namespace App\Http\Controllers;

use App\Models\Mozgasfej;
use App\Models\Mozgastetel;
use App\Models\RaktarKeszlet;
use App\Models\Szamla;
use App\Models\Szamlatetel;
use App\Models\Termek;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Flash;

use App\Classes\MozgasClass;

class SzamlaFeldolgozasController extends Controller
{

    public function __construct()
    {
        //
    }

    /**
     * Számla tételek mennyiségi bevételezése
     *
     * @param $id
     *
     * @return void
     */
    public function szamlaFeldolgozas($id)
    {
        $szamla = Szamla::where('id', $id)->first();
        if ( $szamla->feldolgozott != 0 ) {
            Flash::error('A tétel feldolgozott!')->important();
        }
        if ( $szamla->feldolgozott == 0 ) {

            /* ide kell a mozgasbizonylatfej */
            $mozgasFej = new Mozgasfej;
            $mozgasFej->mozgaskod_id = 1;
            $mozgasFej->datum = \Carbon\Carbon::now();
            $mozgasFej->partner = $szamla->partner;
            $mozgasFej->bizszam = MozgasClass::kovetkezoBizszam(1);
            $mozgasFej->raktar = 2093;
            $mozgasFej->bf = 0;
            $mozgasFej->feldolgozott = 1;
            $mozgasFej->save();

            $szamlaTetelek = Szamlatetel::where('szamla', $id)->get();
            foreach ($szamlaTetelek as $key => $szamlaTetel ) {
                $termek = Termek::where('id', $szamlaTetel->termek)->first();
                if ($termek->tsz == 2071) {

                    /* ide kell a mozgasbizonylat tétel */
                    $mozgasTetel = new Mozgastetel;
                    $mozgasTetel->mozgasfej = $mozgasFej->id;
                    $mozgasTetel->termek = $termek->id;
                    $mozgasTetel->mennyiseg =  $szamlaTetel->mennyiseg;
                    $mozgasTetel->save();

                    $termek->mennyiseg = $termek->mennyiseg + $szamlaTetel->mennyiseg;
                    $termek->save();

                    $raktarkeszlet = RaktarKeszlet::where('raktar_id', 2093)
                                                  ->where('termek_id', $szamlaTetel->termek)
                                                  ->first();

                    if ( !empty($raktarkeszlet) ) {
                        $raktarkeszlet->mennyiseg = $raktarkeszlet->mennyiseg + $szamlaTetel->mennyiseg;
                        $raktarkeszlet->save();
                    }

                    if ( empty($raktarkeszlet) ) {
                        $raktarkeszlet = RaktarKeszlet::create([
                            'raktar_id' => 2093,
                            'termek_id' => $szamlaTetel->termek,
                            'mennyiseg' => $szamlaTetel->mennyiseg
                        ]);
                    }
                }
            }

            $szamla->mozgasfej_id = $mozgasFej->id;
            $szamla->feldolgozott = 1;
            $szamla->save();

        }

        return view('szamlas.index');
    }
}
