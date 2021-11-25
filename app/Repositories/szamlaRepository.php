<?php

namespace App\Repositories;

use App\Models\Szamla;
use App\Repositories\BaseRepository;

/**
 * Class szamlaRepository
 * @package App\Repositories
 * @version July 8, 2020, 7:25 am UTC
*/

class szamlaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'partner',
        'szamlaszam',
        'fizitesimod',
        'osszeg',
        'kelt',
        'teljesites',
        'fizetesihatarido',
        'feldolgozott',
        'mozgasfej_id'
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
        return szamla::class;
    }
}
