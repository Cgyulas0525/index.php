<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Vevoirendelestetel
 * @package App\Models
 * @version November 13, 2021, 6:46 am UTC
 *
 * @property integer vevoimegrendelesfej_id
 * @property integer termek_id
 * @property number mennyiseg
 * @property number atadott
 * @property string megjegyzes
 */
class Vevoirendelestetel extends Model
{
    use SoftDeletes;

    public $table = 'vevoirendelestetel';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'vevoirendelesfej_id',
        'termek_id',
        'mennyiseg',
        'atadott',
        'megjegyzes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'vevoirendelesfej_id' => 'integer',
        'termek_id' => 'integer',
        'mennyiseg' => 'float',
        'atadott' => 'float',
        'megjegyzes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'vevoirendelesfej_id' => 'required',
        'termek_id' => 'required',
        'mennyiseg' => 'required'
    ];

    protected $append = ['termeknev'];

    public function vevoirendelesfej()
    {
        return $this->belongsTo('App\Models\Vevoirendelesfej');
    }

    public function termek() {
        return $this->belongsTo('App\Models\Termek');
    }

    public function getTermekNevAttribute() {
        return !empty($this->termek_id) ? Termek::where('id', $this->termek_id)->first()->nev : '';
    }

}
