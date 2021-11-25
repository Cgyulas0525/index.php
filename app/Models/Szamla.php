<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\Models\Dictionary;
use App\Models\Partner;
use App\Models\Szamlatetel;

/**
 * Class szamla
 * @package App\Models
 * @version July 8, 2020, 7:25 am UTC
 *
 * @property integer partner
 * @property string szamlaszam
 * @property integer fizitesimod
 * @property number osszeg
 * @property string kelt
 * @property string teljesites
 * @property string fizetesihatarido
 * @property integer mozgasfej_id
 */
class Szamla extends Model
{
    use SoftDeletes;

    public $table = 'szamla';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'partner',
        'szamlaszam',
        'fizitesimod',
        'osszeg',
        'kelt',
        'teljesites',
        'fizetesihatarido',
        'feldolgozott',
        'mozgasfej_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'partner' => 'integer',
        'szamlaszam' => 'string',
        'fizitesimod' => 'integer',
        'osszeg' => 'float',
        'kelt' => 'date',
        'teljesites' => 'date',
        'fizetesihatarido' => 'date',
        'feldolgozott' => 'integer',
        'mozgasfej_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'szamlaszam' => 'required',
        'fizitesimod' => 'required',
        'osszeg' => 'required',
        'kelt' => 'required',
        'teljesites' => 'required',
        'fizetesihatarido' => 'required'
    ];

    protected $append = ['partnernev', 'fizetesimodnev', 'tetelszam', 'bizonylatszam'];

    public function mozgasfej() {
        return $this->belongsTo('App\Models\Mozgasfej');
    }

    public function partneradat() {
        return $this->belongsTo('App\Models\Partner', 'partner');
    }

    public function fizetesimodadat() {
        return $this->belongsTo('App\Models\Dictonary', 'fizetesimod');
    }

    public function szamlatetel() {
        return $this->hasMany('App\Models\Szamlatetel', 'szamla');
    }


    public function getPartnerNevAttribute() {
        return !empty($this->partner) ? Partner::where('id', $this->partner)->first()->nev : '';
    }

    public function getFizetesimodNevAttribute() {
        return !empty($this->fizitesimod) ? Dictionary::where('id', $this->fizitesimod)->first()->nev : '';
    }

    public function getTetelSzamAttribute() {
        return Szamlatetel::where('szamla', $this->id)->count();
    }

    public function getBizonylatSzamAttribute() {
        return !empty($this->mozgasfej_id) ? Mozgasfej::where('id', $this->mozgasfej_id)->first()->bizszam : '';
    }

}
