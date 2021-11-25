<?php

namespace App\Repositories;

use App\Models\Mozgasfej;
use App\Repositories\BaseRepository;

/**
 * Class MozgasfejRepository
 * @package App\Repositories
 * @version October 4, 2020, 11:11 am UTC
*/

class MozgasfejRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'mozgasfej_id',
        'datum',
        'partner',
        'bizszam',
        'raktar',
        'bf',
        'feldolgozott'
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
        return Mozgasfej::class;
    }
}
