<?php

namespace App\Repositories;

use App\Models\Megrendelesfej;
use App\Repositories\BaseRepository;

/**
 * Class MegrendelesfejRepository
 * @package App\Repositories
 * @version November 10, 2020, 3:14 pm UTC
*/

class MegrendelesfejRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'megrendelesszam',
        'datum',
        'partner'
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
        return Megrendelesfej::class;
    }
}
