<?php

namespace App\Repositories;

use App\Models\LeltarTetel;
use App\Repositories\BaseRepository;

/**
 * Class LeltarTetelRepository
 * @package App\Repositories
 * @version June 9, 2021, 3:53 pm UTC
*/

class LeltarTetelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'leltarfej_id',
        'termek_id',
        'darab'
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
        return LeltarTetel::class;
    }
}
