<?php

namespace App\Http\Controllers;

use App\Models\PenztarFej;
use App\Models\Zaras;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public static function penztarNapiForgalom()
    {
        return PenztarFej::whereDate('created_at', '=', Carbon::today()->toDateString())->get()->sum('ertek');
    }

    public static function penztarForgalomSzazalek()
    {
        $napiForgalom = PenztarFej::whereDate('created_at', '=', Carbon::today()->toDateString())->get()->sum('ertek');
        if ( $napiForgalom != 0 ) {
            $kezdo = date('Y-m-d', strtotime('first day of january 2010'));
            $veg   = date('Y-m-d', strtotime('last day of december this year'));
            $atlag = Zaras::whereBetween('datum', [$kezdo, $veg])->get()->sum('osszeg') / Zaras::whereBetween('datum', [$kezdo, $veg])->count();
            return round($napiForgalom / ($atlag / 100), 0);
        }
        return 0;
    }
}
