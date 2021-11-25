<?php
namespace App\Classes;
use App\Models\Lista;
use Redirect,Response,DB;

use App\Models\Termek;
use App\Models\Termekcsoport;
use App\Models\Termekfocsoport;
use App\Models\Partner;
use App\Models\Koltsegcsoport;
use App\Models\Koltsegfocsoport;
use App\Models\Dictionary;
use App\Models\Mozgaskod;
use App\Models\Mozgasfej;
use App\Models\Modul;

class DDW{

    public static function termekDdw() {
        return [" "] + Termek::orderBy('nev')->pluck('nev', 'id')->toArray();
    }

    public static function termekCsoportDdw() {
        return [" "] + Termekcsoport::orderBy('nev')->pluck('nev', 'id')->toArray();
    }

    public static function termekFoCsoportDdw() {
        return [" "] + Termekfocsoport::orderBy('nev')->pluck('nev', 'id')->toArray();
    }

    public static function partnerDdw() {
        return [" "] + Partner::orderBy('nev')->pluck('nev', 'id')->toArray();
    }

    public static function partnerSzallitoDdw() {
        return [" "] + Partner::whereIn('tipus', array(2052, 2053, 2087, 2088, 2102))->orderBy('nev')->pluck('nev', 'id')->toArray();
    }

    public static function vevoDdw() {
        return [" "] + Partner::where('tipus', '=', 2054)->orderBy('nev')->pluck('nev', 'id')->toArray();
    }

    public static function koltsegCsoportDdw() {
        return [" "] + Koltsegcsoport::orderBy('nev')->pluck('nev', 'id')->toArray();
    }

    public static function koltsegFoCsoportDdw() {
        return [" "] + Koltsegfocsoport::orderBy('nev')->pluck('nev', 'id')->toArray();
    }

    public static function dictionaryDdw($tipus) {
        return [" "] + Dictionary::where('tipus', '=', $tipus)->orderBy('nev')->pluck('nev', 'id')->toArray();
    }

    public static function mozgasKodDdw() {
        return [" "] + Mozgaskod::orderBy('nev')->pluck('nev', 'id')->toArray();
    }

    public static function mozgasFejDdw() {
        return [" "] + Mozgasfej::orderBy('bizszam')->pluck('bizszam', 'id')->toArray();
    }

    public static function modulDdw() {
        return [" "] + Modul::orderBy('nev')->pluck('nev', 'id')->toArray();
    }

    public static function listaDdw($modul) {
        return [" "] + Lista::where('modul_id', function($query) use ($modul) {
                return $query->from('modul')->select('id')->where('nev', $modul)->first();
            })->orderBy('nev')->pluck('nev', 'url')->toArray();
    }

    public static function peksegDdw() {
        return [" "] + Partner::where('tipus', 2102)->orderBy('nev')->pluck('nev', 'id')->toArray();
    }

}
