<?php

namespace App\Repositories;

use App\Models\Zaras;
use App\Repositories\BaseRepository;

/**
 * Class ZarasRepository
 * @package App\Repositories
 * @version September 30, 2020, 6:18 am UTC
*/

class ZarasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        'szep'.
        'napkozben'
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
        return Zaras::class;
    }
}
