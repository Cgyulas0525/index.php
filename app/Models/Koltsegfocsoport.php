<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * Class Koltsegfocsoport
 * @package App\Models
 * @version July 5, 2020, 12:44 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection koltsegcsoports
 * @property string nev
 * @property string megjegyzes
 */
class Koltsegfocsoport extends Model
{
    use SoftDeletes;

    public $table = 'koltsegfocsoport';

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

    public function koltsegcsoport() {
        return $this->hasMany('App\Models\Koltsegcsoport', 'focsoport');
    }

}
