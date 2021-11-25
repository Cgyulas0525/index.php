<?php
namespace App\Classes;
use App\Models\Szamla;
use DB;

class SzamlaClass{

    public static function aktualisEvOsszKoltseg() {
        $kezdo = date('Y-m-d', strtotime('first day of january this year'));
        $veg   = date('Y-m-d', strtotime('last day of december this year'));
        return Szamla::whereBetween('kelt', [$kezdo, $veg])->sum('osszeg');
    }

    public static function aktualisHaviOsszKoltseg() {
        $kezdo = date('Y-m-d', strtotime('first day of this month'));
        $veg   = date('Y-m-d', strtotime('last day of this month'));
        return Szamla::whereBetween('kelt', [$kezdo, $veg])->sum('osszeg');
    }

    public static function SzamlaOsszPartnerenkent() {
        return DB::table('szamla')
                 ->join('partner', 'partner.id', 'szamla.partner')
                 ->select('partner.nev as nev', DB::raw('sum(osszeg) as osszeg'))
                 ->groupBy('partner.nev')
                 ->get();
    }
}
