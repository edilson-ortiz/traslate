<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HttpController extends Controller
{
    public function __invoke(Request $request){

        dd();

        $response = Http::timeout(60)->withHeaders([
            'Authorization' => "Token " . env('DEEPGRAM_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.deepgram.com/v1/listen?smart_format=true&language=es&model=nova-2',[
            'url' => 'https://res.cloudinary.com/dvvppi3g2/video/upload/v1722130826/Audio_de_una_hora_z5hhlm.mp3',
        ]);

        return $response;
    }
}