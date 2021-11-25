<?php
namespace App\Classes;

use App\Models\Mozgaskod;
use App\Models\Mozgasfej;
use App\Models\MozgasTetel;
use App\Models\Termek;
use App\Models\RaktarKeszlet;

class MozgasKonyvelesClass{

    /**
     * mozgás bizonylat könyvelés
     *
     * @param App\Models\Mozgasfej->id
     *
     * @return void
     */
    public static function mozgasKonyveles($id) {

        // fej és mozgás adatok
        $mozgasFej = Mozgasfej::where('id', $id)->first();
        $mozgas = Mozgaskod::where('id', $mozgasFej->mozgaskod_id)->first();

        // tételek
        $mozgasTetelek = Mozgastetel::where('mozgasfej', $id)->get();

        foreach ($mozgasTetelek as $key => $mozgasTetel) {

            // 2093 bolt, 2094 raktár
            // készlet csökkentő tétel
            if ( $mozgas->honnan == 2093 || $mozgas->honnan == 2094 ) {

                $raktarKeszlet = RaktarKeszlet::where('raktar_id', $mozgas->honnan)->where('termek_id', $mozgasTetel->termek)->first();
                if ( !empty($raktarKeszlet) ) {
                    $raktarKeszlet->mennyiseg = $raktarKeszlet->mennyiseg - $mozgasTetel->mennyiseg;
                    $raktarKeszlet->save();

                    $keszlet = Termek::where('id', $mozgasTetel->termek)->first();
                    $keszlet->mennyiseg = $keszlet->mennyiseg - $mozgasTetel->mennyiseg;
                    $keszlet->save();
                }

            }

            // készlet növelő tétel
            if ( $mozgas->hova == 2093 || $mozgas->hova == 2094 ) {

                if ( RaktarKeszlet::where('raktar_id', $mozgas->hova)->where('termek_id', $mozgasTetel->termek)->count() == 0 ) {

                    $raktarKeszlet = RaktarKeszlet::create([
                        'raktar_id' => $mozgas->hova,
                        'termek_id' => $mozgasTetel->termek,
                        'mennyiseg' => $mozgasTetel->mennyiseg
                    ]);

                } else {

                    $raktarKeszlet = RaktarKeszlet::where('raktar_id', $mozgas->hova)->where('termek_id', $mozgasTetel->termek)->first();
                    $raktarKeszlet->mennyiseg = $raktarKeszlet->mennyiseg + $mozgasTetel->mennyiseg;
                    $raktarKeszlet->save();

                }

                $keszlet = Termek::where('id', $mozgasTetel->termek)->first();
                $keszlet->mennyiseg = $keszlet->mennyiseg + $mozgasTetel->mennyiseg;
                $keszlet->save();

            }
        }

        $mozgasFej->feldolgozott = 1;
        $mozgasFej->save();

    }
}
