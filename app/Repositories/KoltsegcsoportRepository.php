<?php

namespace App\Repositories;

use App\Models\Koltsegcsoport;
use App\Repositories\BaseRepository;

/**
 * Class KoltsegcsoportRepository
 * @package App\Repositories
 * @version July 5, 2020, 12:43 pm UTC
*/

class KoltsegcsoportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'focsoport',
        'nev',
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
        return Koltsegcsoport::class;
    }
}
