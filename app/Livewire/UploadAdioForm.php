<?php

namespace App\Livewire;

use App\Livewire\Document as LivewireDocument;
use App\Models\Document;
use App\Services\Convertio;
use App\Services\Upload;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class UploadAdioForm extends Component
{
    use LivewireAlert;
    public $name, $dataAudio;

    protected $rules = [
        'dataAudio' => 'required',
    ];

    protected $messages = [
        'dataAudio.required' => 'Por favor, seleccione un archivo de audio para continuar.',
    ];

    protected $listeners = ['urlName'];

    public function urlName($url)
    {
        if ($url == null) {
            Upload::delete($this->dataAudio['public_id']);
        } else {
            $this->dataAudio = json_decode($url, true);
        }
    }

    public function save()
    {

        $this->validate();
        
        $url = $this->dataAudio['secure_url'];
        try {
            $response = Convertio::Upload($url);
            $context = $response['transcript'];
            $tiempo = $this->formatBySegundo($response['duration']);

            Document::create([
                'nombre' =>  $this->dataAudio['public_id'],
                'tiempo' => $tiempo,
                'context' => $context,
                'state' => true,
                'activo' => true,
                'user_id' => Auth::user()->id,
                'url' => $url
            ]);
            $this->clear();
            $this->dispatch('update-document')->to(LivewireDocument::class);
            $this->alert('success', 'Procesando Correctamente!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
        } catch (\Throwable $th) {
            Document::create([
                'nombre' =>  $this->dataAudio['public_id'],
                'tiempo' => "00:00:00",
                'context' => "Error",
                'state' => false,
                'activo' => true,
                'user_id' => Auth::user()->id,
                'url' => $url
            ]);
            $this->alert('error', 'Error al procesar!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
        }
        $this->dispatch('post-created'); 
    }
    public function clear()
    {
        $this->name = null;
        $this->dataAudio = null;
    }

    public function formatBySegundo($seg)
    {
        $hours = floor($seg / 3600);
        $minutes = floor(($seg % 3600) / 60);
        $seconds = $seg % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    public function render()
    {
        return view('livewire.upload-adio-form');
    }
}