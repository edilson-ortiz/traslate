<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadAudio(Request $request)
    {
        if ($request->hasFile("audio")) {
            $result = $request->file('audio')->storeOnCloudinary('Audio');
            return response()->json([
                'public_id' => $result->getPublicId(),
                'secure_url' => $result->getSecurePath()
            ]);
        }


        return "hola mundo";
    }

    public function deleteAudio()
    {
        $publicId = request()->getContent();       
        Cloudinary::destroy($publicId,["resource_type" => "video", "type" => "upload"]);
        return 'Eliminado con exito';
    }
}