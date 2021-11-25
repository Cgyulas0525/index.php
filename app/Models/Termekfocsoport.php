<?php

namespace App\Models;

use App\Models\Kep;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

use App\Models\Dictionary;



/**
 * Class termekfocsoport
 * @package App\Models
 * @version July 13, 2020, 6:30 am UTC
 *
 * @property string nev
 * @property string megjegyzes
 */
class Termekfocsoport extends Model
{
    use SoftDeletes;

    public $table = 'termekfocsoport';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nev',
        'tsz',
        'megjegyzes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nev' => 'string',
        'tsz' => 'integer',
        'megjegyzes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nev' => 'required',
        'tsz' => 'required'
    ];

    protected $append = ['tsznev', 'fokep'];

    public function szotaradat() {
        return $this->belongsTo('App\Models\Dictionary', 'tsz');
    }

    public function termekcsoport() {
        return $this->hasMany('App\Models\Termekcsoport', 'focsoport');
    }

    public function getTsznevAttribute() {
        return !empty($this->tsz) ? Dictionary::where('id', $this->tsz)->first()->nev : '';
    }

    public function getFokepAttribute() {
        $kep = NULL;
        if (Kep::where('parent_id', $this->id)->where('dictionary_id', 2109)->count() > 0) {
            if (Kep::where('parent_id', $this->id)->where('fokep', 1)->where('dictionary_id', 2109)->count() > 0) {
                $kep = Kep::where('parent_id', $this->id)->where('fokep', 1)->where('dictionary_id', 2109)->first()->kicsikep;
            } else {
                $kep = Kep::where('parent_id', $this->id)->where('dictionary_id', 2109)->first()->kicsikep;
            }
        }
        return $kep;
    }

}
