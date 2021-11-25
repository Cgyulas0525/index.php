<?php

namespace App\Repositories;

use App\Models\Termekcsoport;
use App\Repositories\BaseRepository;

/**
 * Class termekcsoportRepository
 * @package App\Repositories
 * @version July 13, 2020, 6:31 am UTC
*/

class termekcsoportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'focsoport',
        'nev',
        'afa',
        'haszonkulcs',
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
        return termekcsoport::class;
    }
}
