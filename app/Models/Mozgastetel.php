<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Termek;

/**
 * Class Mozgastetel
 * @package App\Models
 * @version October 4, 2020, 11:12 am UTC
 *
 * @property integer mozgasfej
 * @property integer termek
 * @property integer mennyiseg
 */
class Mozgastetel extends Model
{
    use SoftDeletes;

    public $table = 'mozgastetel';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'mozgasfej',
        'termek',
        'mennyiseg'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'mozgasfej' => 'integer',
        'termek' => 'integer',
        'mennyiseg' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    protected $append = ['termeknev', 'bizonylat'];

    public function mozgasfejadat() {
        return $this->belongsTo('App\Models\Mozgasfej', 'mozgasfej');
    }

    public function termekadat() {
        return $this->belongsTo('App\Models\Termek', 'termek');
    }

    public function getTermeknevattribute() {
        return !empty($this->termek) ? Termek::where('id', $this->termek)->first()->nev : '';
    }

    public function getBizonylatAttribute() {
        return !empty($this->termek) ? Termek::where('id', $this->termek)->first()->nev : '';
    }

}
