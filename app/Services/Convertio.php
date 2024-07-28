<?php

namespace App\Services;

use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\Cast\String_;

class Convertio
{
    public static function Upload(String $url, $ia = 'deep')
    {
        $data = self::convertioByDeepgram($url);
        return $data;
    }
    
    public static function convertioByDeepgram($url)
    {   
        $response = Http::timeout(500)->connectTimeout(500)->withHeaders([
            'Authorization' => "Token " . env('DEEPGRAM_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.deepgram.com/v1/listen?smart_format=true&language=es&model=nova-2',[
            'url' => $url,
        ]);
        
        $data = json_decode($response->body(), true);
        $duration = $data['metadata']['duration'] ?? 'No disponible';
        $transcript = $data['results']['channels'][0]['alternatives'][0]['transcript'] ?? 'No disponible';
        return [
            'duration' => $duration,
            'transcript' => $transcript,
        ];
    }
}