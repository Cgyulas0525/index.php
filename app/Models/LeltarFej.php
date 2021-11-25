<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Dictionary;

/**
 * Class LeltarFej
 * @package App\Models
 * @version June 9, 2021, 3:52 pm UTC
 *
 * @property string datum
 * @property integer raktar_id
 */
class LeltarFej extends Model
{
    use SoftDeletes;

    public $table = 'leltarfej';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'datum',
        'raktar_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'datum' => 'date',
        'raktar_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    protected $append = ['raktarnev', 'tetelszam'];

    public function leltartetel() {
        return $this->hasMany('App\Models\LeltarTetel');
    }

    public function raktar() {
        return $this->belongsTo('App\Models\Dictionary', 'raktar_id');
    }

    public function getRaktarnevAttribute() {
        return !empty($this->raktar_id) ? Dictionary::where('id', $this->raktar_id)->first()->nev : '';
    }

    public function getTetelSzamAttribute() {
        return LeltarTetel::where('leltarfej_id', $this->id)->count();
    }


}
