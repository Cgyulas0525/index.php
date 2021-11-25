<?php

namespace App\Models;

use App\Classes\Api;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class termek
 * @package App\Models
 * @version July 8, 2020, 7:24 am UTC
 *
 * @property string nev
 * @property string cikkszam
 * @property string barcode
 * @property integer me
 * @property integer tsz
 * @property string megjegyzes
 */
class Termek extends Model
{
    use SoftDeletes;

    public $table = 'termek';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nev',
        'csoport',
        'cikkszam',
        'barcode',
        'me',
        'mennyiseg',
        'minmenny',
        'beszar',
        'ar',
        'partner',
        'glutenmentes',
        'laktozmentes',
        'tejmentes',
        'tojasmentes',
        'cukormentes',
        'vegan',
        'megjegyzes',
        'energiakj',
        'energiakcal',
        'zsir',
        'telitett',
        'szenhidrat',
        'cukor',
        'rost',
        'feherje',
        'so',
        'osszetevok'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nev' => 'string',
        'csoport' => 'integer',
        'cikkszam' => 'string',
        'barcode' => 'string',
        'me' => 'integer',
        'mennyiseg' => 'integer',
        'minmenny' => 'integer',
        'beszar' => 'integer',
        'ar' => 'integer',
        'partner' => 'integer',
        'glutenmentes' => 'integer',
        'laktozmentes' => 'integer',
        'tejmentes' => 'integer',
        'tojasmentes' => 'integer',
        'cukormentes' => 'integer',
        'vegan' => 'integer',
        'megjegyzes' => 'string',
        'energiakj' => 'integer',
        'energiakcal' => 'integer',
        'zsir' => 'float',
        'telitett' => 'float',
        'szenhidrat' => 'float',
        'cukor' => 'float',
        'rost' => 'float',
        'feherje' => 'float',
        'so' => 'float',
        'osszetevok' => 'string'
    ];

    protected $attributes = [
        'glutenmentes' => 0,
        'laktozmentes' => 0,
        'tejmentes' => 0,
        'tojasmentes' => 0,
        'tojasmentes' => 0,
        'vegan' => 0,
        'energiakj' => 0,
        'energiakcal' => 0,
        'zsir' => 0,
        'telitett' => 0,
        'szenhidrat' => 0,
        'cukor' => 0,
        'rost' => 0,
        'feherje' => 0,
        'so' => 0
    ];

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'glutenmentes' => ['accepted'],
            'laktozmentes' => ['accepted'],
            'tejmentes' => ['accepted'],
            'tojasmentes' => ['accepted'],
            'tojasmentes' => ['accepted'],
            'vegan' => ['accepted'],
        ]);
    }

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nev' => 'required',
        'csoport' => 'required',
        'cikkszam' => 'required',
    ];

    protected $append = [ 'focsoportnev', 'csoportnev', 'menev', 'partnernev', 'cikkszambarcode',
                         'cbarcode', 'termektipus', 'afa', 'tsz', 'focsoport', 'afaszazlek', 'afaertek', 'fokep'];

    public function meadat() {
        return $this->belongsTo('App\Models\Dictionary', 'me');
    }

    public function csoportadat() {
        return $this->belongsTo('App\Models\Termekcsoport', 'csoport');
    }

    public function partneradat() {
        return $this->belongsTo('App\Models\Partner', 'partner');
    }

    public function szamlatetel() {
        return $this->hasMany('App\Models\Szamlatetel', 'termek');
    }

    public function mozgastetel() {
        return $this->hasMany('App\Models\Mozgastetel', 'termek');
    }

    public function raktarkeszlet() {
        return $this->hasMany('App\Models\RaktarKeszlet');
    }

    public function penztartetel() {
        return $this->hasMany('App\Models\PenztarTetel');
    }

    public function megrendelestetel() {
        return $this->hasMany('App\Models\MegrendelesTetel', 'termek');
    }

    public function getCsoportnevattribute() {
        return !empty($this->csoport) ? Termekcsoport::where('id', $this->csoport)->first()->nev : '';
    }

    public function getFoCsoportnevattribute() {
        return !empty($this->csoport) ? Termekfocsoport::where('id', function($query) {
            return $query->from('termekcsoport')->select('focsoport')->where('id', $this->csoport)->first();
        })->first()->nev : '';
    }

    public function getFoCsoportattribute() {
        return !empty($this->csoport) ? Termekcsoport::where('id', $this->csoport)->first()->focsoport : '';
    }

    public function getMenevattribute() {
        return !empty($this->me) ? Dictionary::where('id', $this->me)->first()->nev : '';
    }

    public function getPartnernevattribute() {
        return !empty($this->partner) ? Partner::where('id', $this->partner)->first()->nev : '';
    }

    public function getCikkszamBarcodeattribute() {
        return Api::barcodeCode($this->cikkszam);
    }

    public function getCBarcodeattribute() {
        if ( !empty( $this->barcode) ) {
            return Api::barcodeCode($this->barcode);
        }
        if ( empty( $this->barcode) ) {
            return Api::barcodeCode($this->cikkszam);
        }
    }

    public function getTermekTipusattribute() {
        return Termekfocsoport::where('id', function($query){
            return $query->from('termekcsoport')->select('focsoport')->where('id', $this->csoport)->first();
        })->first()->nev;
    }

    public function getAfaattribute() {
        return !empty($this->csoport) ? Termekcsoport::where('id', $this->csoport)->first()->afa : '';
    }

    public function getAfaSzazalekAttribute() {
        $afa = !empty($this->csoport) ? Termekcsoport::where('id', $this->csoport)->first()->afa : '';
        if ( $afa == 2081 || $afa == 2084 ) {
            return 0;
        }
        if ( $afa == 2082 ) {
            return 5;
        }
        if ( $afa == 2083 ) {
            return 27;
        }
        if ( $afa == 2085 ) {
            return 18;
        }

        return 0;
    }

    public function getAfaErtekAttribute() {
        $afa = !empty($this->csoport) ? Termekcsoport::where('id', $this->csoport)->first()->afa : '';
        if ( $afa == 2081 || $afa == 2084 ) {
            $szaz = 0;
        }
        if ( $afa == 2082 ) {
            $szaz = 5;
        }
        if ( $afa == 2083 ) {
            $szaz = 27;
        }
        if ( $afa == 2085 ) {
            $szaz = 18;
        }
        return  round(($this->ar / (100 + $szaz)), 0) * $szaz;
    }

    public function getTszAttribute() {
        return Termekfocsoport::where('id', function($query){
            return $query->from('termekcsoport')->select('focsoport')->where('id', $this->csoport)->first();
        })->first()->tsz;
    }

    public function getFokepAttribute() {
        $kep = NULL;
        if (Kep::where('parent_id', $this->id)->where('dictionary_id', 2111)->count() > 0) {
            if (Kep::where('parent_id', $this->id)->where('fokep', 1)->where('dictionary_id', 2111)->count() > 0) {
                $kep = Kep::where('parent_id', $this->id)->where('fokep', 1)->where('dictionary_id', 2111)->first()->kicsikep;
            } else {
                $kep = Kep::where('parent_id', $this->id)->where('dictionary_id', 2111)->first()->kicsikep;
            }
        }
        return $kep;
    }

}
