<?php

namespace App\Repositories;

use App\Models\LeltarFej;
use App\Repositories\BaseRepository;

/**
 * Class LeltarFejRepository
 * @package App\Repositories
 * @version June 9, 2021, 3:52 pm UTC
*/

class LeltarFejRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'datum',
        'raktar_id'
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
        return LeltarFej::class;
    }
}
