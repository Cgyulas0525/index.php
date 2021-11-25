<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

/**
 * Class PostRepository
 * @package App\Repositories
 * @version November 17, 2020, 7:40 am UTC
*/

class PostRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'image_url'
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
        return Post::class;
    }

    public function createPost(Request $request){
        $file = $request->file('image_url');
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();


        $path = 'upload/'.uniqid().'.'.$extension;
        $img = Image::make($file);
        $img->save(public_path($path));

        $input = $request->all();
        $imageUrl = 'public/'.$path;
        $input['image_url'] = $imageUrl;

        return $this->create($input);
    }

}
