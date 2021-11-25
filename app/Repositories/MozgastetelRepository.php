<?php

namespace App\Repositories;

use App\Models\Mozgastetel;
use App\Repositories\BaseRepository;

/**
 * Class MozgastetelRepository
 * @package App\Repositories
 * @version October 4, 2020, 11:12 am UTC
*/

class MozgastetelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'mozgasfej',
        'termek',
        'mennyiseg'
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
        return Mozgastetel::class;
    }
}
