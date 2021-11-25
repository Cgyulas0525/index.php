<?php
namespace App\Classes;
use Redirect,Response,DB;

class Koltseg{

    public static function  getEvHonapKoltseg()
    {
        $kezdo = date('Y-m-d', strtotime('first day of this month - 5'));
        $veg   = date('Y-m-d', strtotime('last day of this month'));
        $data  = DB::table('szamlatetel as p1')
                      ->join('szamla as p2', 'p2.id', '=', 'p1.szamla')
                      ->select(DB::raw("CONCAT(year(p2.teljesites), '.', lpad(month(p2.teljesites), 2, 0)) as honap, sum(p1.brutto) as db"))
                      ->whereBetween('p2.teljesites', [$kezdo, $veg])
                      ->whereNull('p1.deleted_at')
                      ->orderBy('honap')
                      ->groupBy('honap')
                      ->get();
        return $data;
    }

    public static function  getEvHetKoltseg()
    {
        $kezdo = date('Y-m-d', strtotime('first day of this month - 2'));
        $veg   = date('Y-m-d', strtotime('last day of this month'));
        $data  = DB::table('szamlatetel as p1')
                      ->join('szamla as p2', 'p2.id', '=', 'p1.szamla')
                      ->select(DB::raw("CONCAT(year(p2.teljesites), '.', lpad(week(p2.teljesites), 2, 0)) as honap, sum(p1.brutto) as db"))
                      ->whereBetween('p2.teljesites', [$kezdo, $veg])
                      ->whereNull('p1.deleted_at')
                      ->orderBy('honap')
                      ->groupBy('honap')
                      ->get();
        return $data;
    }

    public static function KoltsegFoCsoportOsszesen($kezdo, $veg, $focsoport) {
        if ($focsoport != NULL){
            $data = DB::table('szamlatetel as t1')
                        ->join('koltsegcsoport as t2', 't2.id', '=', 't1.koltseg')
                        ->join('koltsegfocsoport as t3', 't3.id', '=', 't2.focsoport')
                        ->join('szamla as t4', 't4.id', '=', 't1.szamla')
                        ->select(DB::raw('t3.nev as nev, sum(t1.brutto) as osszeg'))
                        ->whereIn('t2.focsoport', $focsoport)
                        ->whereBetween('t4.kelt', [$kezdo, $veg])
                        ->groupBy('t3.nev')
                        ->get();
        }else {
            $data = DB::table('szamlatetel as t1')
                        ->join('koltsegcsoport as t2', 't2.id', '=', 't1.koltseg')
                        ->join('koltsegfocsoport as t3', 't3.id', '=', 't2.focsoport')
                        ->join('szamla as t4', 't4.id', '=', 't1.szamla')
                        ->select(DB::raw('t3.nev as nev, sum(t1.brutto) as osszeg'))
                        ->whereBetween('t4.kelt', [$kezdo, $veg])
                        ->groupBy('t3.nev')
                        ->get();
        }
        return $data;
    }

    /**
     * heti kiadás bevétel összesen
     *
     * @param date $kezdo
     * @param date $veg
     *
     * @return $data
     */
    public static function hetiBevetelKiadas($kezdo, $veg)
    {

        $query1 = DB::table('zaras as t')
                    ->select(DB::raw('concat(CONCAT(year(t.datum),"."), if(CAST(week(t.datum) AS UNSIGNED) < 10, concat("0", week(t.datum)), week(t.datum))) nev, PenztarSum(t.id) as bevetel, 0 as kiadas'))
                    ->whereBetween('t.datum', [$kezdo, $veg])
                    ->whereNull('t.deleted_at');

        $query2 = DB::table('szamla as t1')
                    ->select(DB::raw('concat(CONCAT(year(t1.kelt),"."), if(CAST(week(t1.kelt) AS UNSIGNED) < 10, concat("0", week(t1.kelt)), week(t1.kelt))) nev, 0 as bevetel, t1.osszeg as kiadas'))
                    ->whereBetween('t1.kelt', [$kezdo, $veg])
                    ->whereNull('t1.deleted_at')
                    ->union($query1);

        $data = DB::query()->fromSub($query2, 'p_pn')
                    ->select('nev', DB::raw('ROUND( SUM(bevetel), 0) as bev, ROUND( SUM(kiadas), 0) as kiad'))
                    ->groupBy('nev')
                    ->get();

        return $data;
    }

    /**
     * havi kiadás bevétel összesen
     *
     * @param date $kezdo
     * @param date $veg
     *
     * @return $data
     */
    public static function haviBevetelKiadas($kezdo, $veg)
    {

        $query1 = DB::table('zaras as t')
                    ->select(DB::raw('concat(CONCAT(year(t.datum),"."), if(CAST(month(t.datum) AS UNSIGNED) < 10, concat("0", month(t.datum)), month(t.datum))) nev, PenztarSum(t.id) as bevetel, 0 as kiadas'))
                    ->whereBetween('t.datum', [$kezdo, $veg])
                    ->whereNull('t.deleted_at');

        $query2 = DB::table('szamla as t1')
                    ->select(DB::raw('concat(CONCAT(year(t1.kelt),"."), if(CAST(month(t1.kelt) AS UNSIGNED) < 10, concat("0", month(t1.kelt)), month(t1.kelt))) nev, 0 as bevetel, t1.osszeg as kiadas'))
                    ->whereBetween('t1.kelt', [$kezdo, $veg])
                    ->whereNull('t1.deleted_at')
                    ->union($query1);

        $data = DB::query()->fromSub($query2, 'p_pn')
                    ->select('nev', DB::raw('ROUND( SUM(bevetel), 0) as bev,
                                                          ROUND( SUM(kiadas), 0) as kiad,
                                                          (ROUND( SUM(bevetel), 0) - ROUND( SUM(kiadas), 0)) as egyenleg'))
                    ->groupBy('nev')
                    ->get();

        return $data;
    }

}
