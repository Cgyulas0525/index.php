<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * Class Koltsegcsoport
 * @package App\Models
 * @version July 5, 2020, 12:43 pm UTC
 *
 * @property \App\Models\Koltsegfocsoport focsoport
 * @property integer csoport
 * @property string nev
 * @property string megjegyzes
 */
class Koltsegcsoport extends Model
{
    use SoftDeletes;

    public $table = 'koltsegcsoport';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'focsoport',
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
        'focsoport' => 'integer',
        'nev' => 'string',
        'megjegyzes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'focsoport' => 'required',
        'nev' => 'required'
    ];

    public function focsoportadat() {
        return $this->belongsTo('App\Models\Koltsegfocsoport', 'focsoport');
    }

    public function szamlatetel() {
        return $this->hasMany('App\Models\Szamlatetel', 'koltseg');
    }

}
