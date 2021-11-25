<?php

namespace App\Repositories;

use App\Models\PenztarFej;

/**
 * Class PenztarFejRepository
 * @package App\Repositories
 * @version June 2, 2021, 4:45 pm UTC
*/

class PenztarFejRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'bizonylatszam',
        'ertek'
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
        return PenztarFej::class;
    }
}
