<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PenztarFej
 * @package App\Models
 * @version June 2, 2021, 4:45 pm UTC
 *
 * @property string bizonylatszam
 * @property integer ertek
 */
class PenztarFej extends Model
{
    use SoftDeletes;

    public $table = 'penztarfej';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'bizonylatszam',
        'ertek'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'bizonylatszam' => 'string',
        'ertek' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    protected $append = ['netto', 'afa', 'brutto'];

    public function penztartetel() {
        return $this->hasMany('App\Models\PenztarTetel');
    }

    public function getNettoAttribute() {
        return PenztarTetel::where('penztarfej_id', $this->id)->get()->sum('netto');
    }

    public function getAfaAttribute() {
        return PenztarTetel::where('penztarfej_id', $this->id)->get()->sum('afa');
    }

    public function getBruttoAttribute() {
        return PenztarTetel::where('penztarfej_id', $this->id)->get()->sum('brutto');
    }

}
