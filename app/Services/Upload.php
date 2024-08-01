<?php

namespace App\Services;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Storage;

class Upload
{
    static public function upload($audioFile){  
        $filePath = $audioFile->store('audio', 'public');
        return Storage::url($filePath);
    }

    static public function delete($publicId){
        Cloudinary::destroy($publicId,["resource_type" => "video", "type" => "upload"]);
    }

    static public function getUrl($publicId){
        return cloudinary()->getUrl($publicId);
    }
}