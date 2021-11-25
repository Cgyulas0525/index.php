<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

use App\Classes\Api;

/**
 * Class Zaras
 * @package App\Models
 * @version September 30, 2020, 6:18 am UTC
 *
 * @property string datum
 * @property integer 5
 * @property integer 10
 * @property integer 20
 * @property integer 50
 * @property integer 100
 * @property integer 200
 * @property integer 500
 * @property integer 1000
 * @property integer 2000
 * @property integer 5000
 * @property integer 10000
 * @property integer 20000
 * @property integer kartya
 * @property integer szep
 */
class Zaras extends Model
{
    use SoftDeletes;

    public $table = 'zaras';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'datum',
        'A5',
        'A10',
        'A20',
        'A50',
        'A100',
        'A200',
        'A500',
        'A1000',
        'A2000',
        'A5000',
        'A10000',
        'A20000',
        'kartya',
        'szep',
        'napkozben'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'datum' => 'date',
        'A5' => 'integer',
        'A10' => 'integer',
        'A20' => 'integer',
        'A50' => 'integer',
        'A100' => 'integer',
        'A200' => 'integer',
        'A500' => 'integer',
        'A1000' => 'integer',
        'A2000' => 'integer',
        'A5000' => 'integer',
        'A10000' => 'integer',
        'A20000' => 'integer',
        'kartya' => 'integer',
        'szep' => 'integer',
        'napkozben' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'datum' => 'required',
    ];

    protected $append = ['osszeg', 'napnev'];

    /* appended fields */
    public function getOsszegAttribute() {
	    return ((($this->A5 * 5) + ($this->A10 * 10)  + ($this->A20 * 20) + ($this->A50 * 50) +
              ($this->A100 * 100) + ($this->A200 * 200) + ($this->A500 * 500) + ($this->A1000 * 1000) +
              ($this->A2000 * 2000) + ($this->A5000 * 5000) + ($this->A10000 * 10000) +
              ($this->A20000 * 20000) + $this->kartya + $this->szep + $this->napkozben) - 20000);
    }

    public function getNapnevAttribute() {
        return Api::napNev($this->datum);
    }

}
