<?php

namespace App\Repositories;

use App\Models\Termekfocsoport;

/**
 * Class termekfocsoportRepository
 * @package App\Repositories
 * @version July 13, 2020, 6:30 am UTC
*/

class termekfocsoportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nev',
        'tsz',
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
        return termekfocsoport::class;
    }
}
