<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RaktarKeszlet
 * @package App\Models
 * @version March 30, 2021, 7:42 am UTC
 *
 * @property integer raktar_id
 * @property integer termek_id
 * @property integer mennyiseg
 */
class RaktarKeszlet extends Model
{
    use SoftDeletes;

    public $table = 'raktarkeszlet';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'raktar_id',
        'termek_id',
        'mennyiseg'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'raktar_id' => 'integer',
        'termek_id' => 'integer',
        'mennyiseg' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'raktar_id' => 'required',
        'termek_id' => 'required',
        'mennyiseg' => 'required'
    ];

    protected $append = ['raktarnev', 'termeknev'];


    public function raktar() {
        return $this->belongsTo('App\Models\Dictionary', 'raktar_id');
    }

    public function termek() {
        return $this->belongsTo('App\Models\Termek');
    }

    public function getTermeknevattribute() {
        return !empty($this->termek_id) ? Termek::where('id', $this->termek_id)->first()->nev : '';
    }

    public function getRaktarnevattribute() {
        return !empty($this->raktar_id) ? Dictionary::where('id', $this->raktar_id)->first()->nev : '';
    }

}
