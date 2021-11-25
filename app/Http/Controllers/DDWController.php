<?php

namespace App\Http\Controllers;

use App\Models\Termekcsoport;
use App\Models\Termekfocsoport;
use Illuminate\Http\Request;

class DDWController extends Controller
{

    /**
     * termék főcsoport ddw
     *
     * @return array|string[]
     */
    public static function termekFoCsoportDdw() {
        return [" "] + Termekfocsoport::orderBy('nev')->pluck('nev', 'id')->toArray();
    }

    public static function termekFocsoportCsoportDdw(Request $request) {
        return Termekcsoport::where('focsoport', $request->focsoport)->select('nev', 'id')->orderBy('nev')->get();
    }


    /**
     * üres ddw
     *
     * @return string[]
     */
    public static function uresDdw()
    {
        $data = [" "];
        return $data;
    }
}

