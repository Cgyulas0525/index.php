<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PenztarTetel
 * @package App\Models
 * @version June 2, 2021, 4:46 pm UTC
 *
 * @property integer penztarfej_id
 * @property string sorszam
 * @property integer termek_id
 * @property integer darab
 * @property integer netto
 * @property integer afa
 * @property integer brutto
 */
class PenztarTetel extends Model
{
    use SoftDeletes;

    public $table = 'penztartetel';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'penztarfej_id',
        'sorszam',
        'termek_id',
        'darab',
        'netto',
        'afa',
        'brutto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'penztarfej_id' => 'integer',
        'sorszam' => 'string',
        'termek_id' => 'integer',
        'darab' => 'integer',
        'netto' => 'integer',
        'afa' => 'integer',
        'brutto' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function penztarfej() {
        return $this->belongsTo('App\Models\PenztarFej');
    }

    public function termek() {
        return $this->belongsTo('App\Models\Termek');
    }

    protected $append = ['penztarfej', 'termek'];

    public function getPenztarfejAttribute() {
        return PenztarFej::where('id', $this->penztarfej_id)->first()->bizonylatszam;
    }

    public function getTermekAttribute() {
        return Termek::where('id', $this->termek_id)->first()->nev;
    }

}
