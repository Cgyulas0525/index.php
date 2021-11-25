<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Modulidoszak
 * @package App\Models
 * @version July 5, 2021, 3:40 pm UTC
 *
 * @property integer modul_id
 * @property string nev
 * @property integer dictionaries_id
 * @property integer hossz
 * @property string megjegyzes
 */
class Modulidoszak extends Model
{
    use SoftDeletes;

    public $table = 'modulidoszak';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'modul_id',
        'nev',
        'dictionaries_id',
        'hossz',
        'megjegyzes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'modul_id' => 'integer',
        'nev' => 'string',
        'dictionaries_id' => 'integer',
        'hossz' => 'integer',
        'megjegyzes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'modul_id' => 'required',
        'nev' => 'required',
        'dictionaries_id' => 'required',
        'hossz' => 'required'
    ];

    protected $append = ['modulnev', 'szotarnev'];

    public function modul() {
        return $this->belongsTo('App\Models\Modul');
    }

    public function dictionary() {
        return $this->belongsTo('App\Models\Dictionary');
    }

    public function getModulnevAttribute() {
        return !empty($this->modul_id) ? Modul::where('id', $this->modul_id)->first()->nev : '';
    }

    public function getSzotarnevAttribute() {
        return !empty($this->dictionaries_id) ? Dictionary::where('id', $this->dictionaries_id)->first()->nev : '';
    }

}
