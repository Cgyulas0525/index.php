<?php
namespace App\Classes;

use App\Models\Termek;
use App\Classes\Api;

class TermekClass {

    public static function Cikkszamozo() {
        $termekek = Termek::where('cikkszam', '')->get();
        foreach ($termekek  as $key => $termek) {
            $cikkszam = 'T-'. (string)((int)Api::getMaxTermekCikkszam($termek->csoport) + 1);
            $termek->cikkszam = $cikkszam;
            $termek->save();
        }
    }

}
