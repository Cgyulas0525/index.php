<?php
namespace App\Classes;

use App\Models\Mozgasfej;
use App\Models\Mozgaskod;
use App\Models\MozgasTetel;

class MozgasClass{

    /**
     * Az adott bizonylat típús következő bizonylatszáma
     *
     * @param App\Models\Mozgaskod->id
     *
     * @param App\Models\Mozgasfej->bizszam
     */
    public static function kovetkezoBizszam($mozgas) {

        // a mozgás kód prefixe
        $prefix = Mozgaskod::where('id', $mozgas)->first()->prefix;

        // hány ilyen bizonylat van
        $db = Mozgasfej::where("bizszam", "LIKE", $prefix . "%")->count();


        // ha van  már ilyen bizonylat
        if ( $db != 0 ) {

            // az utosó bizonylatszám
            $bizszam = Mozgasfej::where("bizszam", "LIKE", $prefix . "%")->max('bizszam');

            // növelni egyel
            $szam = strval(intval(substr($bizszam, strpos($bizszam, '-') + 1)) + 1);

            // bizonylatszám
            $bizszam = $prefix.'-'.str_pad('', 6 - strlen($szam), '0').$szam;

        }

        // ha nincs még ilyen bizonylat
        if ( $db == 0 ) {

            // bizonylatszám
            $bizszam = $prefix.'-000001';
        }

        return $bizszam;
    }

    public static function felhasznalasbolBevet($id)
    {
        $mozgas = Mozgasfej::where('id', $id)->first();

        $values = array('datum' => \Carbon\Carbon::now(),
                        'partner' => $mozgas->partner,
                        'bizszam' =>'Felhasználás',
                        'bf' => 2,
                        'feldolgozott' => 0);

        $mozgasfej = Mozgasfej::create([
                                'datum' => \Carbon\Carbon::now(),
                                'partner' => $mozgas->partner,
                                'bizszam' =>'Felhasználás',
                                'bf' => 2,
                                'feldolgozott' => 0
                        ]);

        $tetelek = Mozgastetel::where('mozgasfej', $id)->get();

        foreach ($tetelek as $key => $tetel) {

            Mozgastetel::create([
                        'mozgasfej' => $mozgasfej->id,
                        'termek' => $tetel->termek,
                        'mennyiseg' => $tetel->mennyiseg
            ]);
        }

        return $mozgasfej->id;
    }

}
