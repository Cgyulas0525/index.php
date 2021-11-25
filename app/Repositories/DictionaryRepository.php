<?php

namespace App\Repositories;

use App\Models\Dictionary;
use App\Repositories\BaseRepository;

/**
 * Class DictionaryRepository
 * @package App\Repositories
 * @version October 10, 2019, 12:20 pm UTC
*/

class DictionaryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipus_id',
        'nev',
        'leiras',
        'user_id'
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
        return Dictionary::class;
    }
}
