<?php

namespace App\Repositories;

use App\Models\PenztarTetel;
use App\Repositories\BaseRepository;

/**
 * Class PenztarTetelRepository
 * @package App\Repositories
 * @version June 2, 2021, 4:46 pm UTC
*/

class PenztarTetelRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'penztarfej_id',
        'sorszam',
        'termek_id',
        'darab',
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
        return PenztarTetel::class;
    }
}
