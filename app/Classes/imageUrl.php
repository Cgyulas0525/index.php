<?php
namespace App\Classes;

use Intervention\Image\Facades\Image;
use DB;

Class imageUrl{

    public static function kepFeltolt($file) {

        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();

        $path = 'upload/'.uniqid().'.'.$extension;
        $img = Image::make($file);
        $img->save(public_path($path));

        $imageUrl = 'public/'.$path;

        return $imageUrl;
    }

    public static function kepNev($file) {
        return "../" . $file;
    }

    public static function kepKicsi($file) {

        $extension = substr($file, strpos($file, '.') + 1, strlen($file));;

        $path = 'upload/kicsi/'.uniqid().'.'.$extension;
        $img = Image::make($file)->resize(40,40);
        $img->save(public_path($path));

        $imageUrl = 'public/'.$path;

        return $imageUrl;
    }

}
