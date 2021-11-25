<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Modul
 * @package App\Models
 * @version June 26, 2021, 6:05 am UTC
 *
 * @property string nev
 * @property string megjegyzes
 */
class Modul extends Model
{
    use SoftDeletes;

    public $table = 'modul';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nev',
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

    protected $append = ['listadarab', 'idoszakdarab', 'szurodarab'];


    public function lista() {
        return $this->hasMany('App\Models\Lista');
    }

    public function modulidoszak() {
        return $this->hasMany('App\Models\Modulidoszak');
    }

    public function modulszuro() {
        return $this->hasMany('App\Models\Modulszuro');
    }

    public function getListaDarabAttribute() {
        return Lista::where('modul_id', $this->id)->count();
    }

    public function getIdoszakDarabAttribute() {
        return Modulidoszak::where('modul_id', $this->id)->count();
    }

    public function getSzuroDarabAttribute() {
        return Moduliszuro::where('modul_id', $this->id)->count();
    }

}
