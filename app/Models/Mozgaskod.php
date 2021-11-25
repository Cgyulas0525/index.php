<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Mozgaskod
 * @package App\Models
 * @version March 26, 2021, 3:41 pm UTC
 *
 * @property string nev
 * @property string prefix
 * @property integer honnan
 * @property integer hova
 * @property integer pm
 * @property string megjegyzes
 */
class Mozgaskod extends Model
{
    use SoftDeletes;

    public $table = 'mozgaskod';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nev',
        'prefix',
        'honnan',
        'hova',
        'pm',
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
        'prefix' => 'string',
        'honnan' => 'integer',
        'hova' => 'integer',
        'pm' => 'integer',
        'megjegyzes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nev' => 'required',
        'prefix' => 'required',
        'honnan' => 'required',
        'hova' => 'required',
        'pm' => 'required'
    ];
    
    protected $append = ['honnannev', 'hovanev', 'pmnev'];

    public function honnanadat() {
        return $this->belongsTo('App\Models\Dictionary', 'honnan');
    }

    public function hovaadat() {
        return $this->belongsTo('App\Models\Dictionary', 'hova');
    }

    public function pmadat() {
        return $this->belongsTo('App\Models\Dictionary', 'pm');
    }

    public function mozgasfej() {
        return $this->hasMany('App\Models\Mozgasfej');
    }

    public function getHonnannevattribute() {
        return !empty($this->honnan) ? Dictionary::where('id', $this->honnan)->first()->nev : '';
    }
    
    public function getHovanevattribute() {
        return !empty($this->hova) ? Dictionary::where('id', $this->hova)->first()->nev : '';
    }    

    public function getPmnevattribute() {
        return !empty($this->pm) ? Dictionary::where('id', $this->pm)->first()->nev : '';
    }    
}
