<?php

namespace App\Repositories;

use App\Models\Vevoirendelestetel;
use App\Repositories\BaseRepository;

/**
 * Class VevoirendelestetelRepository
 * @package App\Repositories
 * @version November 13, 2021, 6:46 am UTC
*/

class VevoirendelestetelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'vevoirendelesfej_id',
        'termek_id',
        'mennyiseg',
        'atadott',
        'megjegyzes'
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
        return Vevoirendelestetel::class;
    }
}
