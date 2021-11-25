<?php

namespace App\Repositories;

use App\Models\Termek;

/**
 * Class termekRepository
 * @package App\Repositories
 * @version July 8, 2020, 7:24 am UTC
*/

class termekRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nev',
        'csoport',
        'cikkszam',
        'barcode',
        'me',
        'mannyiseg',
        'beszar',
        'ar',
        'partner',
        'glutenmentes',
        'laktozmentes',
        'tejmentes',
        'tojasmentes',
        'cukormentes',
        'vegan',
        'megjegyzes',
        'energiakj',
        'energiakcal',
        'zsir',
        'telitett',
        'szenhidrat',
        'cukor',
        'rost',
        'feherje',
        'so',
        'osszetevok'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return termek::class;
    }
}
