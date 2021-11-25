<?php

namespace App\Repositories;

use App\Models\Koltsegfocsoport;
use App\Repositories\BaseRepository;

/**
 * Class KoltsegfocsoportRepository
 * @package App\Repositories
 * @version July 5, 2020, 12:44 pm UTC
*/

class KoltsegfocsoportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return Koltsegfocsoport::class;
    }
}
