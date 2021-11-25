<?php

namespace App\Repositories;

use App\Models\Modulszuro;
use App\Repositories\BaseRepository;

/**
 * Class ModulszuroRepository
 * @package App\Repositories
 * @version July 8, 2021, 10:14 am UTC
*/

class ModulszuroRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'modul_id',
        'sorszam',
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
        return Modulszuro::class;
    }
}
