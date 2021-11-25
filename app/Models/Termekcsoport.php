<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class termekcsoport
 * @package App\Models
 * @version July 13, 2020, 6:31 am UTC
 *
 * @property integer focsoport
 * @property string nev
 * @property string megjegyzes
 */
class Termekcsoport extends Model
{
    use SoftDeletes;

    public $table = 'termekcsoport';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'focsoport',
        'nev',
        'afa',
        'haszonkulcs',
        'megjegyzes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'focsoport' => 'integer',
        'nev' => 'string',
        'afa' => 'integer',
        'haszonkulcs' => 'integer',
        'megjegyzes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'focsoport' => 'required',
        'nev' => 'required',
        'afa' => 'required',
        'haszonkulcs' => 'required'
    ];

    protected $append = ['focsoportnev', 'afanev', 'tipus', 'fokep'];

    public function focsoportadat() {
        return $this->belongsTo('App\Models\Termekfocsoport', 'focsoport');
    }

    public function afaadat() {
        return $this->belongsTo('App\Models\Dictionary', 'afa');
    }

    public function getAfanevAttribute() {
        return !empty($this->afa) ? Dictionary::where('id', $this->afa)->first()->nev : '';
    }

    public function getFocsoportnevAttribute() {
        return !empty($this->focsoport) ? Termekfocsoport::where('id', $this->focsoport)->first()->nev : '';
    }

    public function getTipusAttribute() {
        return !empty($this->focsoport) ? Termekfocsoport::where('id', $this->focsoport)->first()->tsz : '';
    }

    public function getFokepAttribute() {
        $kep = NULL;
        if (Kep::where('parent_id', $this->id)->where('dictionary_id', 2110)->count() > 0) {
            if (Kep::where('parent_id', $this->id)->where('fokep', 1)->where('dictionary_id', 2110)->count() > 0) {
                $kep = Kep::where('parent_id', $this->id)->where('fokep', 1)->where('dictionary_id', 2110)->first()->kicsikep;
            } else {
                $kep = Kep::where('parent_id', $this->id)->where('dictionary_id', 2110)->first()->kicsikep;
            }
        }
        return $kep;
    }

}
