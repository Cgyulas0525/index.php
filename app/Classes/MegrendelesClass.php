<?php
namespace App\Classes;

use App\Models\Megrendelesfej;
use App\Models\Vevoirendelesfej;
use DB;

class MegrendelesClass{

    public static function megrendelesAdatok($id) {
        $megrendelesFej = Megrendelesfej::find($id);
        return !empty($megrendelesFej) ? $megrendelesFej->partnernev .' '. $megrendelesFej->megrendelesszam .' '. $megrendelesFej->datum->format('Y-m-d') : ' ';
    }

    public static function magerendelesAfa($id) {
        return DB::table('megrendelestetel as t')
                ->join('termek as t1', 't1.id', 't.termek')
                ->join('termekcsoport as t2', 't2.id', 't1.csoport')
                ->select(DB::raw('Sum(termekErtekAfa( t.termek, t.ertek)) ertek, afaSzazalekErtek(t2.afa) afa'))
                ->where('t.megrendelesfej', $id)
                ->whereNull('t.deleted_at')
                ->groupBy('afa')
                ->orderBy('afa')
                ->get();
    }

    public static function vevoiMegrendelesAdatok($id) {
        $megrendelesFej = Vevoirendelesfej::find($id);
        return !empty($megrendelesFej) ? $megrendelesFej->partnernev .' '. $megrendelesFej->megrendelesszam .' '. $megrendelesFej->mikorra->format('Y-m-d') : ' ';
    }

}
