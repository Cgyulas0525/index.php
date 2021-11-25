<?php
namespace App\Classes;
use App\Models\Partner;
use App\Models\Telepules;

class PartnerClass{
    
    public static function partnerCim($id) {
        $partner = Partner::where('id', $id)->first();
        $varos = Telepules::where('id', $partner->telepules)->first()->telepules;
        return $partner->isz .' '. $varos .' '. $partner->cim;
    }
}
