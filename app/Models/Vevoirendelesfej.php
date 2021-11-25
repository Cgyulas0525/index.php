<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Vevoirendelestetel;

/**
 * Class Vevoirendelesfej
 * @package App\Models
 * @version November 13, 2021, 6:46 am UTC
 *
 * @property integer partner_id
 * @property string mikor
 * @property string mikorra
 * @property integer statusz
 * @property string megjegyzes
 */
class Vevoirendelesfej extends Model
{
    use SoftDeletes;

    public $table = 'vevoirendelesfej';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'megrendelesszam',
        'partner_id',
        'mikor',
        'mikorra',
        'statusz',
        'megjegyzes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'megrendelesszam' => 'string',
        'partner_id' => 'integer',
        'mikor' => 'date',
        'mikorra' => 'date',
        'statusz' => 'integer',
        'megjegyzes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'mikor' => 'required',
        'mikorra' => 'required'
    ];

    protected $append = ['partnernev', 'tetelszam', 'statusznev'];

    public function vevoirendelestetels()
    {
        return $this->hasMany('App\Models\Vevoirendelestetel');
    }

    public function partner() {
        return $this->belongsTo('App\Models\Partner');
    }

    public function statuszadat() {
        return $this->belongsTo('App\Models\Dictionary', 'statusz');
    }

    public function getPartnerNevAttribute() {
        return !empty($this->partner_id) ? Partner::where('id', $this->partner_id)->first()->nev : '';
    }

    public function getStatuszNevAttribute() {
        return !empty($this->statusz) ? Dictionary::where('id', $this->statusz)->first()->nev : '';
    }

    public function getTetelSzamAttribute() {
        return Vevoirendelestetel::where('vevoirendelesfej_id', $this->id)->get()->count();
    }
}
