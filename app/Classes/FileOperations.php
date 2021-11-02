<?php

namespace App\Classes;

use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class FileOperations
{
    public static function StoreFileAs($directory, $uploadedFile, $newFileName){
        return $uploadedFile->storeAs($directory, self::NewFileNameWithExtension($uploadedFile, $newFileName));
    }

    public static function StoreFile($directory, $uploadedFile){
        return $uploadedFile->store($directory);
    }

    public static function NewFileNameWithExtension($uploadedFile, $newFileName){
        return self::SlugifyFileName($newFileName).self::AddExtension($uploadedFile);
    }

    public static function SlugifyFileName($newFileName){
        return Str::slug($newFileName, '-');
    }

    public static function AddExtension($uploadedFile){
        return '.'.$uploadedFile->extension();
    }

    public static function ResizeImage($width, $height, $path){
        Image::make('storage/'.$path)->resize($width, $height)->save('storage/'.$path);
    }
}
