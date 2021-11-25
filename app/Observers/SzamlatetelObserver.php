<?php

namespace App\Observers;

use App\Models\Szamlatetel;
use App\Models\Szamla;

class SzamlatetelObserver
{
    /**
     * Handle the szamlatetel "created" event.
     *
     * @param  \App\Szamlatetel  $szamlatetel
     * @return void
     */
    public function created(Szamlatetel $szamlatetel)
    {
        $this->szamlaOsszeg($szamlatetel->szamla);
    }

    /**
     * Handle the szamlatetel "updated" event.
     *
     * @param  \App\Szamlatetel  $szamlatetel
     * @return void
     */
    public function updated(Szamlatetel $szamlatetel)
    {
        $this->szamlaOsszeg($szamlatetel->szamla);
    }

    /**
     * Handle the szamlatetel "deleted" event.
     *
     * @param  \App\Szamlatetel  $szamlatetel
     * @return void
     */
    public function deleted(Szamlatetel $szamlatetel)
    {
        $this->szamlaOsszeg($szamlatetel->szamla);
    }

    /**
     * Handle the szamlatetel "restored" event.
     *
     * @param  \App\Szamlatetel  $szamlatetel
     * @return void
     */
    public function restored(Szamlatetel $szamlatetel)
    {
        //
    }

    /**
     * Handle the szamlatetel "force deleted" event.
     *
     * @param  \App\Szamlatetel  $szamlatetel
     * @return void
     */
    public function forceDeleted(Szamlatetel $szamlatetel)
    {
        //
    }

    public function szamlaOsszeg($id)
    {
        $szamla = Szamla::where('id', $id)->first();
        $osszeg = Szamlatetel::where('szamla', $id)->get()->sum('brutto');
        $szamla->osszeg = $osszeg;
        $szamla->save();
        $szamla = Szamla::where('id', $id)->first();
    }
}
