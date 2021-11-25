<?php
namespace App\Classes;

use App\Models\Dictionary;
use App\Models\Mozgasfej;
use CodeItNow\BarcodeBundle\Utils\BarcodeGenerator;

use Redirect;
use Response;
use DB;

use App\Models\Termekcsoport;
use App\Models\Termek;
use App\Models\Mozgas;
use App\Models\Mozgastetel;

class Api{

    public static function barcodeCode($kod)
    {
        $barcode = new BarcodeGenerator();
        $barcode->setText($kod);
        $barcode->setType(BarcodeGenerator::Code128);
        $barcode->setScale(2);
        $barcode->setThickness(30);
        $barcode->setFontSize(10);
        return $barcode->generate();

    }

    public static function barcode($kod) {

        $barcode = new BarcodeGenerator();
        $barcode->setText($kod);
        $barcode->setType(BarcodeGenerator::Code128);
        $barcode->setScale(2);
        $barcode->setThickness(15);
        $barcode->setFontSize(10);
        $code = $barcode->generate();

        return '<img src="data:image/png;base64,' . $code . '" />';

    }

    public static function getMozgasFejs($bf) {
        return Mozgasfej::where('bf', $bf)->where('feldolgozott', 0)->get();
    }

    public static function getMozgasTetelDB($id) {
        return Mozgestetel::where('mozgasfej', $id)->count();
    }

    public static function getMozgasTetels($id) {
        return Mozgastetel::where('mozgasfej', $id)->get();
     }

    public static function getMozgasTetelTermek($id) {
        return Termek::where('id', $id)->first();
    }

    public static function setTermekMennyiseg($id, $db) {
        $termek = Termek::where('id', $id)->first();
        $termek->mennyiseg = $db;
        $termek->save();
    }

    public static function setMozgasFejFeldolgozott($id) {
        $mozgasfej = Mozgasfej::where('id', $id)->first();
        $mozgasfej->feldolgozott = 1;
        $mozgasfej->save();
    }

    public static function  getMaxCikkszam($betu) {
        if ( Termek::where('cikkszam', 'like', '%'.$betu.'%')->count() > 0 ) {
            $return = Termek::where('cikkszam', 'like', '%'.$betu.'%')->max('cikkszam');
        } else {
            $return = "0000000";
        }
        return Response::json($return);
    }

    public static function getMaxTermekCikkszam($csoport) {

        if ( Termek::where('cikkszam', 'like', '%T%')->where('csoport', $csoport)->count() > 0) {

            $return = Substr(Termek::where('cikkszam', 'like', '%T%')->where('csoport', $csoport)->max('cikkszam'), 2, 9);

        } else {

            $termekCsoport = Termekcsoport::where('id', $csoport)->first();

            $focsoport = (string)$termekCsoport->focsoport;

            $strCsoport = (string)$csoport;

            if ( strlen($strCsoport) == 1 ) {
                $strCsoport = "00".$strCsoport;
            }

            if ( strlen($strCsoport) == 2 ) {
                $strCsoport = "0".$strCsoport;
            }

            $cikkszam_max = $focsoport.$strCsoport."0000";

            $return = $cikkszam_max;
        }
        return $return;
    }

    /**
     * nap név magyarul
     *
     * @param date $datum
     *
     * @return string $nev
     */
    public static function napNev($datum): string
    {

        $day = date('l', strtotime($datum));

        if ($day == 'Monday') {

            $nev = 'Hétfő';

        } elseif ($day == 'Tuesday') {

            $nev = 'Kedd';

        } elseif ($day == 'Wednesday') {

            $nev = 'Szerda';

        } elseif ($day == 'Thursday') {

            $nev = 'Csütörtök';

        } elseif ($day == 'Friday') {

            $nev = 'Péntek';

        } elseif ($day == 'Saturday') {

            $nev = 'Szombat';

        } elseif ($day == 'Sunday') {

            $nev = 'Vasárnap';

        }else {

            $nev = '';

        }

        return $nev;
    }

    /**
     * A hónap neve magyarul
     *
     * @param integer $honap
     *
     * @return string $nev
     */
    public static function honapNev($honap) {

        if ($honap == 1) {

            $nev = 'január';

        } elseif ($honap == 2) {

            $nev = 'február';

        } elseif ($honap == 3) {

            $nev = 'március';

        } elseif ($honap == 4) {

            $nev = 'április';

        } elseif ($honap == 5) {

            $nev = 'május';

        } elseif ($honap == 6) {

            $nev = 'június';

        } elseif ($honap == 7) {

            $nev = 'július';

        } elseif ($honap == 8) {

            $nev = 'augusztus';

        } elseif ($honap == 9) {

            $nev = 'szeptember';

        } elseif ($honap == 10) {

            $nev = 'október';

        } elseif ($honap == 11) {

            $nev = 'november';

        } elseif ($honap == 12) {

            $nev = 'december';

        }else {

            $nev = '';

        }

        return $nev;
    }

    public static function getDarabId() {
        return Dictionary::where('nev', 'Darab')->where('tipus', 26)->first()->id;
    }

}
