<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Termek;
use App\Models\LeltarFej;

/**
 * Class LeltarTetel
 * @package App\Models
 * @version June 9, 2021, 3:53 pm UTC
 *
 * @property integer leltarfej_id
 * @property integer termek_id
 * @property integer darab
 */
class LeltarTetel extends Model
{
    use SoftDeletes;

    public $table = 'leltartetel';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'leltarfej_id',
        'termek_id',
        'darab'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'leltarfej_id' => 'integer',
        'termek_id' => 'integer',
        'darab' => 'integer'
    ];

    protected $attributes = [
        'darab' => 0
    ];


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'leltarfej_id' => 'required',
        'termek_id' => 'required',
        'darab' => 'required',

    ];

    protected $append = ['termeknev', 'datum'];

    public function leltarfej() {
        return $this->belongsTo('App\Models\LeltarFej');
    }

    public function termek() {
        return $this->belongsTo('App\Models\Termek');
    }

    public function getTermeknevAttribute() {
        return !empty($this->termek_id) ? Termek::where('id', $this->termek_id)->first()->nev : '';
    }

    public function getDatumAttribute() {
        return LeltarFej::where('id', $this->leltarfej_id)->first()->datum;
    }
}
