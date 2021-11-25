<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Telepules;
use App\Models\Dictionary;
use DB;

/**
 * Class Partner
 * @package App\Models
 * @version July 5, 2020, 12:41 pm UTC
 *
 * @property string nev
 * @property integer tipus
 * @property string adoszam
 * @property string bankszamla
 * @property string isz
 * @property integer telepules
 * @property string cim
 * @property string email
 * @property string telefonszam
 * @property string megjegyzes
 */
class Partner extends Model
{
    use SoftDeletes;

    public $table = 'partner';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nev',
        'tipus',
        'adoszam',
        'bankszamla',
        'isz',
        'telepules',
        'cim',
        'email',
        'telefonszam',
        'megjegyzes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nev' => 'string',
        'tipus' => 'integer',
        'adoszam' => 'string',
        'bankszamla' => 'string',
        'isz' => 'string',
        'telepules' => 'integer',
        'cim' => 'string',
        'email' => 'string',
        'telefonszam' => 'string',
        'megjegyzes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nev' => 'required'
    ];

    protected $append = ['telepulesnev', 'tipusnev', 'partnercim'];

    public function telepulesadat() {
        return $this->belongsTo('App\Models\Telepules', 'telepules');
    }

    public function szotaradat() {
        return $this->belongsTo('App\Models\Dictionary', 'tipus');
    }

    public function szamla() {
        return $this->hasMany('App\Models\Szamla', 'partner');
    }

    public function termek() {
        return $this->hasMany('App\Models\Termek', 'partner');
    }

    public function mozgasfej() {
        return $this->hasMany('App\Models\Mozgasfej', 'partner');
    }

    public function megrendelesfej() {
        return $this->hasMany('App\Models\Megrendelesfej', 'partner');
    }


    public function getTelepulesnevttribute() {
        return !empty($this->telepules) ? Telepules::where('id', $this->telepules)->first()->telepules : '';
    }

    public function getTipusnevAttribute() {
        return !empty($this->tipus) ? Dictionary::where('id', $this->tipus)->first()->nev : '';
    }

    public function getPartnerCimAttribute() {
        return ((!empty($this->isz) && $this->isz != 0) ? $this->isz : ' ') . ' ' .
                (!empty($this->telepules) ? Telepules::where('id', $this->telepules)->first()->telepules : ' ') . ' ' .
                (!empty($this->cim) ? $this->cim : ' ');
    }

    public function scopeGetTulajdonos($query, $id){
        return $query->where('tipus', $id)->first();
    }

}
