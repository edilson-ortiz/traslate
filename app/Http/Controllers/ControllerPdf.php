<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ControllerPdf extends Controller
{
    public function showpdf($id)
    {
        $document = Document::find($id);
        $pdf = PDF::loadView('pdf.texto', compact('document'));
        return  $pdf->stream();
    }

    public function upload(Request $request)
    {
        // Validar el archivo
        $request->validate([
            'documento' => 'required|mimes:mp4,mp3,m4a|max:102400', // 200 MB max
            'nombre'=>'required'
        ]);

        
        $result = $request->file('documento')->storeOnCloudinary('laravel');
        Document::create([
            'nombre' =>  $request->nombre,
            'tiempo' => 0,
            'context' => '',
            'state' => false,
            'activo' => true,
            'user_id' => Auth::user()->id,
            'url' => $result->getSecurePath()
        ]);
        return redirect('document');
    }
}