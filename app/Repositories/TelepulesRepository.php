<?php

namespace App\Repositories;

use App\Models\Telepules;

/**
 * Class TelepulesRepository
 * @package App\Repositories
 * @version July 7, 2020, 6:50 am UTC
*/

class TelepulesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'iranyitoszam',
        'telepules',
        'megye',
        'jaras'
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
        return Telepules::class;
    }
}
