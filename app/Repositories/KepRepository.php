<?php

namespace App\Repositories;

use App\Models\Kep;
use App\Repositories\BaseRepository;

/**
 * Class KepRepository
 * @package App\Repositories
 * @version September 7, 2021, 1:57 pm UTC
*/

class KepRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'parent_id',
        'nev',
        'dictionary_id',
        'fokep',
        'kep',
        'kicsikep'
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
        return Kep::class;
    }
}
