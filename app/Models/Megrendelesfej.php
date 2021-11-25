<?php

namespace App\Models;

use App\Models\Partner;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

/**
 * Class Megrendelesfej
 * @package App\Models
 * @version November 10, 2020, 3:14 pm UTC
 *
 * @property \App\Models\Partner partner
 * @property \Illuminate\Database\Eloquent\Collection megrendelestetels
 * @property string datum
 */
class Megrendelesfej extends Model
{
    use SoftDeletes;

    public $table = 'megrendelesfej';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'megrendelesszam',
        'datum',
        'partner'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'megrendelesszam' => 'string',
        'datum' => 'date',
        'partner' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    protected $append = ['partnernev'];

    public function megrendelestetels()
    {
        return $this->hasMany('App\Models\Megrendelestetel', 'megrendelesfej');
    }

    public function partneradat() {
        return $this->belongsTo('App\Models\Partner', 'partner');
    }

    public function getPartnerNevAttribute() {
        return !empty($this->partner) ? Partner::where('id', $this->partner)->first()->nev : '';
    }

}
