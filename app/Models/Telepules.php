<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Telepules
 * @package App\Models
 * @version July 7, 2020, 6:50 am UTC
 *
 * @property string iranyitoszam
 * @property string telepules
 * @property string megye
 * @property string jaras
 */
class Telepules extends Model
{
    use SoftDeletes;

    public $table = 'telepules';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'iranyitoszam',
        'telepules',
        'megye',
        'jaras'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'iranyitoszam' => 'string',
        'telepules' => 'string',
        'megye' => 'string',
        'jaras' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public static function ddwIsz() {
        $vissza = [" "] + \App\Models\Telepules::orderBy('iranyitoszam')->pluck('iranyitoszam', 'iranyitoszam')->toArray();
        return $vissza;
    } 
    
    public static function ddw() {
        $vissza = [" "] + \App\Models\Telepules::orderBy('telepules')->pluck('telepules', 'id')->toArray();
        return $vissza;
    }
    
}
