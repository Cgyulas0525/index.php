<?php

namespace App\Repositories;

use App\Models\Szamlatetel;
use App\Repositories\BaseRepository;

/**
 * Class szamlatetelRepository
 * @package App\Repositories
 * @version July 8, 2020, 7:26 am UTC
*/

class szamlatetelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'szamla',
        'termek',
        'koltseg',
        'afaszaz',
        'mennyiseg',
        'netto',
        'afa',
        'brutto'
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
        return szamlatetel::class;
    }
}
