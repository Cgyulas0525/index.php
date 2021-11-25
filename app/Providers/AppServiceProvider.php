<?php

namespace App\Providers;

use App\Models\LeltarFej;
use App\Models\LeltarTetel;
use App\Models\PenztarTetel;
use App\Models\Szamlatetel;
use App\Observers\LeltarFejObserver;
use App\Observers\LeltarTetelObserver;
use App\Observers\PenztarTetelObserver;
use App\Observers\SzamlatetelObserver;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
     public function boot()
     {
        Schema::defaultStringLength(191);
        config(['chartbuttonvertical' => "public/img/chart/chart-vertical-25.png"]);
        config(['chartbuttonhorizontal' => "public/img/chart/chart-horizontal-25.png"]);
        config(['chartbuttonpolar' => "public/img/chart/chart-polar-alap-25.png"]);
        config(['chartbuttonft' => "public/img/chart/ft.png"]);
        config(['chartbuttoneuro' => "public/img/chart/euro.png"]);
        config(['chartbuttonosszesen' => "public/img/chart/sum.png"]);
        config(['chartbuttonkicsi' => "public/img/chart/make-smaller.png"]);
        config(['chartbuttonnagy' => "public/img/chart/make-bigger.png"]);
        config(['chartbuttoneredeti' => "public/img/chart/make-original.png"]);
        config(['chartbuttontablazat' => "public/img/chart/table.png"]);
        config(['chartbuttonszerzodes' => "public/img/menu/szerzodes_25.png"]);
        config(['chartbuttonszerzodes40' => "public/img/menu/szerzodes_40.png"]);
        config(['chartbuttonszamla40' => "public/img/menu/szamla_40.png"]);

        Szamlatetel::observe(SzamlatetelObserver::class);
        PenztarTetel::observe(PenztarTetelObserver::class);
        LeltarFej::observe(LeltarFejObserver::class);
        LeltarTetel::observe(LeltarTetelObserver::class);

        Str::macro('ezresTagozas', function ($price)
        {
            return number_format($price, 0, '.', '.');
        });
     }

}
