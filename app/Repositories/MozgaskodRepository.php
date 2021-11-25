<?php

namespace App\Repositories;

use App\Models\Mozgaskod;
use App\Repositories\BaseRepository;

/**
 * Class MozgaskodRepository
 * @package App\Repositories
 * @version March 26, 2021, 3:41 pm UTC
*/

class MozgaskodRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nev',
        'prefix',
        'honnan',
        'hova',
        'pm',
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
        return Mozgaskod::class;
    }
}
