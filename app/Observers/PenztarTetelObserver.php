<?php

namespace App\Observers;

use App\Models\PenztarFej;
use App\Models\PenztarTetel;
use App\Models\Termek;

class PenztarTetelObserver
{

    public function afa($penztarTetel)
    {
        $afa = Termek::where('id', $penztarTetel->termek_id)->first()->afa;
        if ( $afa == 2081 || $afa == 2084){
            $szaz = 0;
        }else if ( $afa == 2082){
            $szaz = 5;
        }else if ( $afa == 2085){
            $szaz = 18;
        }else if ($afa == 2083){
            $szaz = 27;
        }
        return $szaz;
    }

    public function penztarFejSave($penztarTetel)
    {
        $penztarFej = PenztarFej::find($penztarTetel->penztarfej_id);
        $penztarFej->ertek = PenztarTetel::where('penztarfej_id', $penztarTetel->penztarfej_id)->get()->sum('brutto');
        $penztarFej->save();
    }
    /**
     * Handle the penztar tetel "creating" event.
     *
     * @param  \App\PenztarTetel  $penztarTetel
     * @return void
     */
    public function creating(PenztarTetel $penztarTetel)
    {
        $szaz = $this->afa($penztarTetel);
        $penztarTetel->netto = round(($penztarTetel->brutto / (100 + $szaz) * 100), 0);
        $penztarTetel->afa = $penztarTetel->brutto - $penztarTetel->netto;
    }
    /**
     * Handle the penztar tetel "created" event.
     *
     * @param  \App\PenztarTetel  $penztarTetel
     * @return void
     */
    public function created(PenztarTetel $penztarTetel)
    {

        $sorszam = PenztarTetel::where('penztarfej_id', $penztarTetel->penztarfej_id)->get()->max('sorszam');
        if ( !empty($sorszam) ) {
            $penztarTetel->sorszam = $sorszam + 1;
        }

        if ( empty($sorszam) ) {
            $penztarTetel->sorszam = 1;
        }

        $this->penztarFejSave($penztarTetel);
    }

    /**
     * Handle the penztar tetel "updated" event.
     *
     * @param  \App\PenztarTetel  $penztarTetel
     * @return void
     */
    public function updated(PenztarTetel $penztarTetel)
    {
        $this->penztarFejSave($penztarTetel);
    }

    /**
     * Handle the penztar tetel "deleted" event.
     *
     * @param  \App\PenztarTetel  $penztarTetel
     * @return void
     */
    public function deleted(PenztarTetel $penztarTetel)
    {
        $this->penztarFejSave($penztarTetel);
    }

    /**
     * Handle the penztar tetel "restored" event.
     *
     * @param  \App\PenztarTetel  $penztarTetel
     * @return void
     */
    public function restored(PenztarTetel $penztarTetel)
    {
        //
    }

    /**
     * Handle the penztar tetel "force deleted" event.
     *
     * @param  \App\PenztarTetel  $penztarTetel
     * @return void
     */
    public function forceDeleted(PenztarTetel $penztarTetel)
    {
        //
    }
}
