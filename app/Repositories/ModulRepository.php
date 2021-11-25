<?php

namespace App\Repositories;

use App\Models\Modul;
use App\Repositories\BaseRepository;

/**
 * Class ModulRepository
 * @package App\Repositories
 * @version June 26, 2021, 6:05 am UTC
*/

class ModulRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        return Modul::class;
    }
}
