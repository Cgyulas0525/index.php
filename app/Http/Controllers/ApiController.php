<?php

namespace App\Http\Controllers;
use App\Models\Kep;
use App\Models\Mozgastetel;
use Illuminate\Http\Request;
use App\Classes\Api;
use Redirect;
use Response;
use DB;
use Datatables;
use Auth;

use App\Classes\ZarasClass;
use App\Models\Partner;
use App\Models\Termekfocsoport;
use App\Models\Telepules;
use App\Models\Termek;
use App\Models\Termekcsoport;
use App\Models\RaktarKeszlet;
use App\Models\LeltarFej;
use App\Models\Modulszuro;

class ApiController extends Controller
{

    public function getTelepulesList(Request $request)
    {
        return Response::json(Telepules::select('telepules, id')->where('iranyitoszam', $request->get('id'))->orderBy('telepules')->get());
    }

    public function getFocsoport(Request $request)
    {
        return Response::json(Termekfocsoport::where('id', '=', $request->get('id'))->first());
   }

   public function getFocsoportFromCsoport(Request $request)
   {
       $id = $request->get('id');
       $return = DB::table('termekfocsoport as t1')
                     ->join('termekcsoport as t2', 't2.focsoport', '=', 't1.id')
                     ->where('t2.id', '=', $id)->get();
       return Response::json($return);
   }

   public function getMaxSzolgaltatasCikkszam(Request $request)
   {
       return Response::json(Api::getMaxCikkszam($request->get('betu')));
   }


   public function getMaxTermekCikkszam(Request $request)
   {
       return Response::json(Api::getMaxTermekCikkszam($request->get('csoport')));
   }

   public function getAfaSzazalek(Request $request)
   {
       $id = $request->get('id');
       $afaszaz = 0;
       if ( $id == 2081 || $id == 2084){
           $afaszaz = 0;
       }else if ( $id == 2082){
           $afaszaz = 5;
       }else if ( $id == 2085){
           $afaszaz = 18;
       }else if ($id == 2083){
           $afaszaz = 27;
       }
       $return = DB::table('dictionaries')
                   ->select(DB::raw($afaszaz.' AS afaszaz'))
                   ->get();
       return Response::json($return);
   }


   public function dashboard(Request $request)
   {
       $data = DB::table('todo')
                 ->join('users as p1', 'p1.id', '=', 'todo.user')
                 ->select('todo.*', 'p1.name as nev')
                 ->whereNull('todo.deleted_at')
                 ->whereNull('todo.vege')
                 ->orderBy('todo.vege', 'todo.mikorra')
                 ->get();

       return Datatables::of($data)
                   ->make(true);

   }

   public static function mozgasBevet(){
       $mfs = Api::getMozgasFejs(1);
       foreach ($mfs as $key => $mf) {
           $count = Api::getMozgasTetelDB($mf->id);
           if ($count > 0){
               $mts = Api::getMozgasTetels($mf->id);
               foreach ($mts as $key => $mt) {
                   $termek = Api::getMozgasTetelTermek($mt->termek);
                   $db = $termek->mennyiseg + $mt->mennyiseg;
                   Api::setTermekMennyiseg($mt->termek, $db);
               }
               Api::setMozgasFejFeldolgozott($mf->id);
           }
       }
       return back();
   }

   public static function mozgasKivet(){
       $mfs = Api::getMozgasFejs(2);
       foreach ($mfs as $key => $mf) {
           $count = Api::getMozgasTetelDB($mf->id);
           if ($count > 0){
               $mts = Api::getMozgasTetels($mf->id);
               foreach ($mts as $key => $mt) {
                   $termek = Api::getMozgasTetelTermek($mt->termek);
                   $db = $termek->mennyiseg - $mt->mennyiseg;
                   Api::setTermekMennyiseg($mt->termek, $db);
               }
               Api::setMozgasFejFeldolgozott($mf->id);
           }
       }
       return back();
   }

    public function vanEBarcode(Request $request)
    {
        return Response::json(Termek::where('barcode', $request->get('barcode'))->get()->count());
    }

    public function getBarcodeTermek(Request $request)
    {
        $termek = Termek::where('barcode', $request->get('barcode'))->first();
        if ( !empty($termek) ) {
            return Response::json($termek);
        } else {
            $termek = Termek::where('cikkszam', $request->get('barcode'))->first();
            return Response::json($termek);
        }
    }

    public function getTermek(Request $request)
    {
        return Response::json(Termek::where('id', $request->get('id'))->first());
    }

    public function getTermekCsoportFromTermek(Request $request)
    {
        $id = $request->get('id');
        $return = Termekcsoport::where('id', function($query) use($id) {
            return $query->from('termek')->select('csoport')->where('id', $id)->first();
        })->first();
        return Response::json($return);
    }

    public function getTermekAfaSzazalek(Request $request)
    {
        $id = $request->get('id');
        $afa = Termek::where('id', $id)->first()->afa;
        $return = 0;
        if ( $afa == 2081 || $afa == 2084){
            $return = 0;
        }else if ( $afa == 2082){
            $return = 5;
        }else if ( $afa == 2085){
            $return = 18;
        }else if ($afa == 2083){
            $return = 27;
        }
        return Response::json($return);
    }

    public function getTermekAfaId(Request $request)
    {
        $id = $request->get('id');
        $return = Termek::where('id', $id)->first()->afa;
        return Response::json($return);
    }

    public function getTermekCsoport(Request $request)
    {
        $id = $request->get('id');
        $return = Termekcsoport::where('id', $id)->first();
        return Response::json($return);
    }

    public function getTermekaBoltban(Request $request)
    {
        $termek = $request->get('termek');
        $return = RaktarKeszlet::where('raktar_id', 2093)->where('termek_id', $termek)->first();
        return Response::json($return);
    }

    public function vanLeltar(Request $request)
    {
        $datum = $request->get('datum');
        $raktar = $request->get('raktar');
        $return = LeltarFej::where('raktar_id', $raktar)->where('datum', $datum)->first();
        return Response::json($return);
    }

    public function getPartner(Request $request)
    {
        return Response::json( Partner::where('id', $request->get('id'))->first() );
    }

    public function getMaxModulszuroSorszam(Request $request)
    {
        $sorszam = Modulszuro::where('modul_id', $request->get('id'))->max('sorszam');
        if (!empty($sorszam)) {
            return Response::json($sorszam + 1);
        } else {
            return Response::json(1);
        }
    }

    public function getTermekRaktaron(Request $request)
    {
        return Response::json( RaktarKeszlet::where('raktar_id', $request->get('raktar'))->where('termek_id', $request->get('termek'))->first() );
    }

    public function getMozgasTermekMennyiseg(Request $request)
    {
        return Response::json( Mozgastetel::where('mozgasfej', $request->get('id'))->where('termek', $request->get('termek'))->get()->sum('mennyiseg') );
    }

    public function vanMarFokep(Request $request)
    {
        return Response::json(Kep::where('parent_id', $request->parent_id)->where('dictionary_id', $request->dictionary_id)->where('fokep', 1)->count());
    }

    public function masikFokep(Request $request)
    {
        return Response::json(Kep::where('parent_id', $request->parent_id)
                                 ->where('dictionary_id', $request->dictionary_id)
                                 ->where('fokep', 1)
                                 ->where('id ', '<>', $request->id)
                                 ->count());
    }

}
