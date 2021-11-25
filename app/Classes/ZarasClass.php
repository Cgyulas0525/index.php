<?php
namespace App\Classes;
use App\Models\Zaras;
use DB;

class ZarasClass {

    public static function hetiArbevetel(){
        return Zaras::selectRaw('year(datum) ev, week(datum) het, sum(kartya) ossz')
                    ->whereYear('datum', '>', '2020')
                    ->groupBy('ev', 'het')
                    ->get();
    }

    public static function arbevetel($kezdo, $veg){

        $zaras = Zaras::selectRaw('sum(((A5 * 5) + (A10 * 10)  + (A20 * 20) + (A50 * 50) +
                                     (A100 * 100) + (A200 * 200) + (A500 * 500) + (A1000 * 1000) +
                                     (A2000 * 2000) + (A5000 * 5000) + (A10000 * 10000) +
                                     (A20000 * 20000) + kartya + szep + napkozben) - 20000) as bevetel, 0 as kiadas,
                                     year(datum) ev, week(datum) het')
                        ->with(['szamla' => function($query) {
                            $query->selectRaw('0 as bevetel, sum(osszeg) as kiadas, year(kelt) ev, week(kelt) het')-get();
                        }])
                       ->whereBetween('datum', [$kezdo, $veg])
                       ->groupBy('ev', 'het')
                       ->get();

        return $zaras;
    }

    /**
     * Időszak napi árbevétel
     *
     * @param date $kezdo
     * @param date $veg
     *
     * @return Zaras $tetelek
     */
    public static function haviNapiArbevetel($kezdo, $veg)
    {
        $tetelek = DB::table('zaras as t')
                     ->select(DB::raw('DAYOFMONTH(t.datum) nap, PenztarSum(t.id) osszeg'))
                     ->whereBetween('t.datum', [$kezdo, $veg])
                     ->whereNull('t.deleted_at')
                     ->get();
        return $tetelek;
    }

    public static function haviNapiArbevetelMegoszlas($kezdo, $veg) {
        $data = DB::table('zaras as t')
                ->select(DB::raw('napNev(t.datum) nev, Sum(PenztarSum(t.id)) osszeg'))
                ->whereBetween('t.datum', [$kezdo, $veg])
                ->whereNull('t.deleted_at')
                ->groupBy('nev')
                ->get();
        return $data;
    }

    public static function getSumArbevetel1() {
        $datas = DB::table('zaras as t')
                 ->select(DB::raw('Sum(PenztarSum(t.id)) as osszeg'))
                 ->whereNull('t.deleted_at')
                 ->get();
        return $datas[0]->osszeg;
    }

    public static function haviNapiArbevetelMegoszlasOszlop($kezdo, $veg) {
        $data = DB::table('zaras as t')
                ->select(DB::raw('napNev(t.datum) nev, weekday(t.datum) nap, Sum(PenztarSum(t.id)) osszeg'))
                ->whereBetween('t.datum', [$kezdo, $veg])
                ->whereNull('t.deleted_at')
                ->groupBy('nev', 'nap')
                ->orderby('nap')
                ->get();
        return $data;
    }

    public static function osszNapiArbevetelMegoszlas() {
        $data = DB::table('zaras as t')
                ->select(DB::raw('napNev(t.datum) nev, Sum(PenztarSum(t.id)) osszeg'))
                ->whereNull('t.deleted_at')
                ->groupBy('nev')
                ->get();
        return $data;
    }

    public static function atlagNapiArbevetelMegoszlasOszlop() {
        $data = DB::table('zaras as t')
                ->select(DB::raw('napNev(t.datum) nev, weekday(t.datum) nap, (Sum(PenztarSum(t.id)) / Sum(1)) osszeg'))
                ->whereNull('t.deleted_at')
                ->groupBy('nev', 'nap')
                ->orderby('nap')
                ->get();
        return $data;
    }

    public static function atlagNapiArbevetelMegoszlas() {
        $data = DB::table('zaras as t')
                ->select(DB::raw('napNev(t.datum) nev, weekday(t.datum) nap, (Sum(PenztarSum(t.id)) / Sum(1)) osszeg, Sum(PenztarSum(t.id)) as napisum'))
                ->whereNull('t.deleted_at')
                ->groupBy('nev', 'nap')
                ->orderby('nap')
                ->get();
        return $data;
    }

    public static function hetiArbevetelMegoszlas($kezdo, $veg) {
        $data = DB::table('zaras as t')
                ->select(DB::raw('concat(year(t.datum), if(CAST(week(t.datum) AS UNSIGNED) < 10, concat("0", week(t.datum)), week(t.datum))) nev, Sum(PenztarSum(t.id)) osszeg'))
                ->whereBetween('t.datum', [$kezdo, $veg])
                ->whereNull('t.deleted_at')
                ->groupBy('nev')
                ->orderBy('nev')
                ->get();
        return $data;
    }

    public static function haviArbevetelMegoszlas($kezdo, $veg) {
        $data = DB::table('zaras as t')
                ->select(DB::raw('concat(year(t.datum), if(CAST(month(t.datum) AS UNSIGNED) < 10, concat("0", month(t.datum)), month(t.datum))) nev, Sum(PenztarSum(t.id)) osszeg'))
                ->whereBetween('t.datum', [$kezdo, $veg])
                ->whereNull('t.deleted_at')
                ->groupBy('nev')
                ->orderBy('nev')
                ->get();
        return $data;
    }

    public static function sumArbevetel() {
        return Zaras::get()->sum('osszeg');
    }

    public static function aktualisEvSumArbevetel() {
        $kezdo = date('Y-m-d', strtotime('first day of january this year'));
        $veg   = date('Y-m-d', strtotime('last day of december this year'));
        return Zaras::whereBetween('datum', [$kezdo, $veg])->get()->sum('osszeg');
    }

    public static function bankkartyaOsszesen() {
        return Zaras::get()->sum('kartya');
    }

    public static function szepkartyaOsszesen() {
        return Zaras::get()->sum('szep');
    }

    public static function aktualisEvBankkartyaOsszesen() {
        $kezdo = date('Y-m-d', strtotime('first day of january this year'));
        $veg   = date('Y-m-d', strtotime('last day of december this year'));
        return Zaras::whereBetween('datum', [$kezdo, $veg])->get()->sum('kartya');
    }

    public static function aktualisEvSZEPkartyaOsszesen() {
        $kezdo = date('Y-m-d', strtotime('first day of january this year'));
        $veg   = date('Y-m-d', strtotime('last day of december this year'));
        return Zaras::whereBetween('datum', [$kezdo, $veg])->get()->sum('szep');
    }

    public static function keszpenzOsszesen() {
        return ZarasClass::sumArbevetel() - (ZarasClass::bankkartyaOsszesen() + ZarasClass::szepkartyaOsszesen());
    }

    public static function aktualisEvKeszpenzOsszesen() {
        return ZarasClass::aktualisEvSumArbevetel() - (ZarasClass::aktualisEvbankkartyaOsszesen() + ZarasClass::aktualisEvSZEPkartyaOsszesen());
    }

    public static function hetiArbevetelKartyaKeszpenz($kezdo, $veg){
        return Zaras::selectRaw('year(datum) ev, week(datum) het, sum(((A5 * 5) + (A10 * 10)  + (A20 * 20) + (A50 * 50) +
                                  (A100 * 100) + (A200 * 200) + (A500 * 500) + (A1000 * 1000) +
                                  (A2000 * 2000) + (A5000 * 5000) + (A10000 * 10000) +
                                  (A20000 * 20000) + kartya + szep + napkozben) - 20000) as ossz, sum(kartya) as kartya')
                     ->whereBetween('datum', [$kezdo, $veg])
                     ->groupBy('ev', 'het')
                     ->get();
    }

    public static function hetDB($kezdo, $veg){
        return Zaras::selectRaw('year(datum) ev, week(datum) het,sum(1) as db')
                     ->whereBetween('datum', [$kezdo, $veg])
                     ->groupBy('ev', 'het')
                     ->get()
                     ->count();
    }

    public static function arbevetelKartyaKeszpenz($kezdo, $veg){
        return Zaras::selectRaw('sum(((A5 * 5) + (A10 * 10)  + (A20 * 20) + (A50 * 50) +
                                  (A100 * 100) + (A200 * 200) + (A500 * 500) + (A1000 * 1000) +
                                  (A2000 * 2000) + (A5000 * 5000) + (A10000 * 10000) +
                                  (A20000 * 20000) + kartya + szep + napkozben) - 20000) as ossz, sum(kartya) as kartya')
                     ->whereBetween('datum', [$kezdo, $veg])
                     ->get();
    }

    public static function proba($kezdo, $veg) {
        $datas = DB::table('zaras as t')
                ->select(DB::raw('concat(year(t.datum), if(CAST(week(t.datum) AS UNSIGNED) < 10, concat("0", week(t.datum)), week(t.datum))) nev, Sum(PenztarSum(t.id)) osszeg'))
                ->whereBetween('t.datum', [$kezdo, $veg])
                ->whereNull('t.deleted_at')
                ->groupBy('nev')->orderBy('nev', 'asc')->get();
        dd($datas);
        return $datas;
    }

    public static function aktualisHaviSumArbevetel() {
        $kezdo = date('Y-m-d', strtotime('first day of this month'));
        $veg   = date('Y-m-d', strtotime('last day of this month'));
        return Zaras::whereBetween('datum', [$kezdo, $veg])->get()->sum('osszeg');
    }

    public static function idoszakiNapiAtlag($days) {
        $kezdo = date('Y-m-d', strtotime('now - ' . $days . ' days'));
        $veg   = date('Y-m-d', strtotime('now'));
        return Zaras::whereBetween('datum', [$kezdo, $veg])->get()->sum('osszeg') / Zaras::whereBetween('datum', [$kezdo, $veg])->get()->count();
    }

}

