<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

use App\Models\Mozgastetel;
use App\Models\Partner;
use App\Models\Dictionary;
use App\Models\Mozgaskod;

/**
 * Class Mozgasfej
 * @package App\Models
 * @version October 4, 2020, 11:11 am UTC
 *
 * @property string datum
 * @property integer partner
 * @property string bizszam
 * @property integer bf
 * @property integer feldolgozott
 */
class Mozgasfej extends Model
{
    use SoftDeletes;

    public $table = 'mozgasfej';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'mozgaskod_id',
        'datum',
        'partner',
        'bizszam',
        'raktar',
        'bf',
        'feldolgozott'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'mozgaskod_id' => 'integer',
        'datum' => 'date',
        'partner' => 'integer',
        'bizszam' => 'string',
        'raktar' => 'integer',
        'bf' => 'integer',
        'feldolgozott' => 'integer'
    ];

    protected $append = ['mozgasnev', 'partnernev', 'raktarnev', 'honnan', 'hova', 'tetel'];

    public function mozgaskod() {
        return $this->belongsTo('App\Models\Mozgaskod');
    }

    public function partneradat() {
        return $this->belongsTo('App\Models\Partner', 'partner');
    }

    public function raktaradat() {
        return $this->belongsTo('App\Models\Dictionary', 'raktar');
    }

    public function mozgastetel() {
        return $this->hasMany('App\Models\Mozgastetel', 'mozgasfej');
    }

    public function szamla() {
        return $this->hasMany('App\Models\Szamla');
    }

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function getPartnernevAttribute() {
        return !empty($this->partner) ? Partner::where('id', $this->partner)->first()->nev : '';
    }

    public function getMozgasnevAttribute() {
        return !empty($this->mozgaskod_id) ? Mozgaskod::where('id', $this->mozgaskod_id)->first()->nev : '';
    }

    public function getRaktarnevAttribute() {
        return !empty($this->raktar) ? Dictionary::where('id', $this->raktar)->first()->nev : '';
    }

    public function getHonnanAttribute() {
        return !empty($this->mozgaskod_id) ? Mozgaskod::where('id', $this->mozgaskod_id)->first()->honnan : '';
    }

    public function getHovaAttribute() {
        return !empty($this->mozgaskod_id) ? Mozgaskod::where('id', $this->mozgaskod_id)->first()->hova : '';
    }

    public function getTetelAttribute() {
        return Mozgastetel::where('mozgasfej', $this->id)->get()->count();
    }
}
