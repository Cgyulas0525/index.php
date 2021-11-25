<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Lista
 * @package App\Models
 * @version June 26, 2021, 6:05 am UTC
 *
 * @property integer modul_id
 * @property string nev
 * @property string megjegyzes
 */
class Lista extends Model
{
    use SoftDeletes;

    public $table = 'lista';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'modul_id',
        'nev',
        'url',
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
        'url' => 'string',
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
        'url' => 'required'
    ];

    protected $append = ['modulnev'];


    public function modul() {
        return $this->belongsTo('App\Models\Modul');
    }

    public function getModulnevAttribute() {
        return !empty($this->modul_id) ? Modul::where('id', $this->modul_id)->first()->nev : '';
    }



}
