<?php

namespace App\Repositories;

use App\Models\Vevoirendelesfej;
use App\Repositories\BaseRepository;

/**
 * Class VevoirendelesfejRepository
 * @package App\Repositories
 * @version November 13, 2021, 6:46 am UTC
*/

class VevoirendelesfejRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'megrendelesszam',
        'partner_id',
        'mikor',
        'mikorra',
        'statusz',
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
        return Vevoirendelesfej::class;
    }
}
