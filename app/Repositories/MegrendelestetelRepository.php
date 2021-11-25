<?php

namespace App\Repositories;

use App\Models\Megrendelestetel;
use App\Repositories\BaseRepository;

/**
 * Class MegrendelestetelRepository
 * @package App\Repositories
 * @version November 10, 2020, 3:14 pm UTC
*/

class MegrendelestetelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'megrendelesfej',
        'termek',
        'mennyiseg',
        'ertek'
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
        return Megrendelestetel::class;
    }
}
