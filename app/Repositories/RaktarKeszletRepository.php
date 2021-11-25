<?php

namespace App\Repositories;

use App\Models\RaktarKeszlet;
use App\Repositories\BaseRepository;

/**
 * Class RaktarKeszletRepository
 * @package App\Repositories
 * @version March 30, 2021, 7:42 am UTC
*/

class RaktarKeszletRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'raktar_id',
        'termek_id',
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
        return RaktarKeszlet::class;
    }
}
