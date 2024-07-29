<?php

use App\Http\Controllers\ControllerPdf;
use App\Http\Controllers\HttpController;
use App\Livewire\Document;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Route::get('/', function () {
    //return view('welcome');
    return redirect('login');
});

#Route::get('/document', Document::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        // return view('dashboard');
        return view('document');
    })->name('dashboard');

    Route::get('/document', function () {
        return view('document');
    })->name('document');

    Route::get('/document/pdf/{id}', [ControllerPdf::class, 'showpdf'])->name('pdf.show');
});



Route::get('convertio', HttpController::class);

Route::get('/upload', function () {
    return view('upload');
});
Route::post('/subir',[ControllerPdf::class, 'upload'])->name('subir');