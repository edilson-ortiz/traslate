<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class CloudinaryController extends Controller
{
    public function upload(Request $request)
    {
        $url = $request->get('cloud_image_url');    
        return response()->json(['message' => 'File uploaded successfully', 'url' => $url], 200);
    }
}