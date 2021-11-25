<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Todo
 * @package App\Models
 * @version August 10, 2020, 6:23 am UTC
 *
 * @property integer user
 * @property string mit
 * @property string mikorra
 * @property string megjegyzes
 */
class Todo extends Model
{
    use SoftDeletes;

    public $table = 'todo';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user',
        'mit',
        'mikorra',
        'vege',
        'megjegyzes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user' => 'integer',
        'mit' => 'string',
        'mikorra' => 'date',
        'vege' => 'date',
        'megjegyzes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user' => 'required',
        'mit' => 'required',
        'mikorra' => 'required'
    ];


}
