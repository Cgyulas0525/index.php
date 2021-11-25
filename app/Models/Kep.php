<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Dictionary;
use App\Models\Termekfocsoport;
use App\Models\Termekcsoport;
use App\Models\Termek;

/**
 * Class Kep
 * @package App\Models
 * @version September 7, 2021, 1:57 pm UTC
 *
 * @property integer parent_id
 * @property integer dictionaries_id
 * @property integer fokep
 * @property string kep
 * @property string kicsikep
 */
class Kep extends Model
{
    use SoftDeletes;

    public $table = 'kep';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'parent_id',
        'nev',
        'dictionary_id',
        'fokep',
        'kep',
        'kicsikep'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'nev' => 'string',
        'dictionary_id' => 'integer',
        'fokep' => 'integer',
        'kep' => 'string',
        'kicsikep' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'parent_id' => 'required',
        'nev' => 'required',
        'dictionary_id' => 'required'
    ];

    public function szotaradat() {
        return $this->belongsTo('App\Models\Dictionary');
    }

    protected $append = ['melyik', 'parentnev'];

    public function getMelyikAttribute() {
        return !empty($this->dictionary_id) ? Dictionary::where('id', $this->dictionary_id)->first()->nev : '';
    }

    public function getParentNevAttribute() {
        if (!empty($this->dictionary_id)) {
            if ($this->dictionary_id == 2109) {
                return Termekfocsoport::find($this->parent_id)->nev;
            }
            if ($this->dictionary_id == 2110) {
                return Termekcsoport::find($this->parent_id)->nev;
            }
            if ($this->dictionary_id == 2111) {
                return Termek::find($this->parent_id)->nev;
            }
        }
        return '';
    }

}
