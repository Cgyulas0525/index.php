<?php

namespace App\Repositories;

use App\Models\Todo;
use App\Repositories\BaseRepository;

/**
 * Class TodoRepository
 * @package App\Repositories
 * @version August 10, 2020, 6:23 am UTC
*/

class TodoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user',
        'mit',
        'mikorra',
        'vege',
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
        return Todo::class;
    }
}
