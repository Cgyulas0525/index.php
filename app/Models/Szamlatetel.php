<?php

namespace App\Models;

use App\Models\Termek;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Dictionary;
use App\Models\Koltsegcsoport;

/**
 * Class szamlatetel
 * @package App\Models
 * @version July 8, 2020, 7:26 am UTC
 *
 * @property integer szamla
 * @property integer termek
 * @property integer koltseg
 * @property integer afaszaz
 * @property number netto
 * @property number afa
 * @property number brutto
 */
class Szamlatetel extends Model
{
    use SoftDeletes;

    public $table = 'szamlatetel';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'szamla',
        'termek',
        'koltseg',
        'afaszaz',
        'mennyiseg',
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
        'szamla' => 'integer',
        'termek' => 'integer',
        'koltseg' => 'integer',
        'afaszaz' => 'integer',
        'mennyiseg' => 'integer',
        'netto' => 'float',
        'afa' => 'float',
        'brutto' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'szamla' => 'required',
        'koltseg' => 'required',
        'afaszaz' => 'required',
        'netto' => 'required',
        'afa' => 'required',
        'brutto' => 'required'
    ];

    protected $append = ['termeknev', 'koltsegnev', 'afanev'];

    public function termekadat() {
        return $this->belongsTo('App\Models\Termek', 'termek');
    }

    public function szamlaadat() {
        return $this->belongsTo('App\Models\Szamla', 'szamla');
    }

    public function koltsegadat() {
        return $this->belongsTo('App\Models\Koltsegcsoport', 'koltseg');
    }

    public function afaadat() {
        return $this->belongsTo('App\Models\Dictionary', 'afaszaz');
    }

    public function getTermekNevAttribute() {
        return !empty($this->termek) ? Termek::where('id', $this->termek)->first()->nev : '';
    }

    public function getKoltsegNevAttribute() {
        return !empty($this->koltseg) ? Koltsegcsoport::where('id', $this->koltseg)->first()->nev : '';
    }

    public function getAfaNevAttribute() {
        return !empty($this->afaszaz) ? Dictionary::where('id', $this->afaszaz)->first()->nev : '';
    }

}
