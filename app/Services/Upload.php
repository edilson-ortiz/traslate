<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class Upload
{
    static public function upload($audioFile){  
        $filePath = $audioFile->store('audio', 'public');
        return Storage::url($filePath);
    }

    static public function delete($url){
        return "";
    }
}