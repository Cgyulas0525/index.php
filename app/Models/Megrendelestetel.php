<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\Models\Termek;

/**
 * Class Megrendelestetel
 * @package App\Models
 * @version November 10, 2020, 3:14 pm UTC
 *
 * @property \App\Models\Megrendelesfej megrendelesfej
 * @property integer termek
 * @property integer mennyiseg
 * @property integer ertek
 */
class Megrendelestetel extends Model
{
    use SoftDeletes;

    public $table = 'megrendelestetel';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'megrendelesfej',
        'termek',
        'mennyiseg',
        'ertek'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'megrendelesfej' => 'integer',
        'termek' => 'integer',
        'mennyiseg' => 'integer',
        'ertek' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    protected $append = ['termeknev'];

    public function megrendelesfej()
    {
        return $this->belongsTo('App\Models\Megrendelesfej', 'megrendelesfej');
    }

    public function termekadat() {
        return $this->belongsTo('App\Models\Termek', 'termek');
    }

    public function getTermekNevAttribute() {
        return !empty($this->termek) ? Termek::where('id', $this->termek)->first()->nev : '';
    }


}
