<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Dictionary
 * @package App\Models
 * @version October 10, 2019, 12:20 pm UTC
 *
 * @property integer tipus_id
 * @property string nev
 * @property string leiras
 * @property integer user_id
 */
class Dictionary extends Model
{
    use SoftDeletes;

    public $table = 'dictionaries';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'tipus',
        'nev',
        'leiras',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'tipus' => 'integer',
        'nev' => 'string',
        'leiras' => 'string',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'tipus' => 'required',
        'nev' => 'required',
    ];

    public function partner() {
        return $this->hasMany('App\Models\Partner', 'tipus');
    }

    public function szamla() {
        return $this->hasMany('App\Models\Szamla', 'fizetesimod');
    }

    public function termekfocsoport() {
        return $this->hasMany('App\Models\Termekfocsoport', 'tsz');
    }

    public function termekcsoport() {
        return $this->hasMany('App\Models\Termekcsoport', 'afa');
    }

    public function termek() {
        return $this->hasMany('App\Models\Termek', 'me');
    }

    public function honnan() {
        return $this->hasMany('App\Models\Mozgaskod', 'honnan');
    }

    public function hova() {
        return $this->hasMany('App\Models\Mozgaskod', 'hova');
    }

    public function pm() {
        return $this->hasMany('App\Models\Mozgaskod', 'pm');
    }

    public function raktar() {
        return $this->hasMany('App\Models\Mozgasfej', 'raktar');
    }

    public function raktarkeszlet() {
        return $this->hasMany('App\Models\RaktarKeszelet', 'raktar_id');
    }

    public function szamlatetel() {
        return $this->hasMany('App\Models\Szamlatetel', 'afaszaz');
    }

    public function leltarfej() {
        return $this->hasMany('App\Models\LeltarFej', 'raktar_id');
    }

    public function modulidoszak() {
        return $this->hasMany('App\Models\Modulidoszak');
    }

    public function kep() {
        return $this->hasMany('App\Models\Kep');
    }

    public function vevoirendelesfej() {
        return $this->hasMany('App\Models\Vevoirendelesfej', 'statusz');
    }

}
