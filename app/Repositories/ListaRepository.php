<?php

namespace App\Repositories;

use App\Models\Lista;
use App\Repositories\BaseRepository;

/**
 * Class ListaRepository
 * @package App\Repositories
 * @version June 26, 2021, 6:05 am UTC
*/

class ListaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'modul_id',
        'nev',
        'url',
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
        return Lista::class;
    }
}
