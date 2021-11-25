<?php

namespace App\Repositories;

use App\Models\Modulidoszak;
use App\Repositories\BaseRepository;

/**
 * Class ModulidoszakRepository
 * @package App\Repositories
 * @version July 5, 2021, 3:40 pm UTC
*/

class ModulidoszakRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'modul_id',
        'nev',
        'dictionaries_id',
        'hossz',
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
        return Modulidoszak::class;
    }
}
