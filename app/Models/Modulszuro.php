<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Modulszuro
 * @package App\Models
 * @version July 8, 2021, 10:14 am UTC
 *
 * @property integer modul_id
 * @property integer sorszam
 * @property string nev
 * @property string megjegyzes
 */
class Modulszuro extends Model
{
    use SoftDeletes;

    public $table = 'modulszuro';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'modul_id',
        'sorszam',
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
        'modul_id' => 'integer',
        'sorszam' => 'integer',
        'nev' => 'string',
        'megjegyzes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'modul_id' => 'required',
        'sorszam' => 'required',
        'nev' => 'required'
    ];

    protected $append = ['modulnev'];

    public function modul() {
        return $this->belongsTo('App\Models\Modul');
    }

    public function getModulnevAttribute() {
        return !empty($this->modul_id) ? Modul::where('id', $this->modul_id)->first()->nev : '';
    }
}
