<?php

namespace App\Services;
use App\Repositories\MarketerRepositoryInterface;
use App\Repositories\UsersRepositoryInterface;

use Illuminate\Http\Request;
use App\Classes\FileOperations;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadFilesServices
{



    public function __construct()
    {



    }


    public function uploadfile($img,$dir){

        $pathAfterUpload = FileOperations::StoreFileAs($dir, $img, $dir.'_'.Str::random(6));

        return $pathAfterUpload;
    }

    public function updateUploadfile($id, $img,$dir,$path=null)
    {
        if ($path==null){
            $service_provider=$this->serviceProviderRepository->findOne($id);
            if (isset($service_provider)) {
                Storage::delete($service_provider->image);
            }

            $marketer=$this->marketerRepository->findOne($id);

            if (isset($marketer)) {
                Storage::delete($marketer->image);
            }
        }



        if(file_exists('storage/'. $path)){

            Storage::delete($path);

        }


        $pathAfterUpload = FileOperations::StoreFileAs($dir, $img, $dir.'_'.Str::random(10));

        return $pathAfterUpload;

    }

    public function deleteUploadfile($path){

        if(file_exists('storage/'. $path)){

            Storage::delete($path);

        }

        return response()->json(['success'=>true]);

    }


}
