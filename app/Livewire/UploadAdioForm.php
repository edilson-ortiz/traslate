<?php

namespace App\Livewire;

use App\Livewire\Document as LivewireDocument;
use App\Models\Document;
use App\Services\Convertio;
use App\Services\Upload;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadAdioForm extends Component
{
    use WithFileUploads;
    use LivewireAlert;
    public $name, $audio;

    public function save()
    {
        $this->name;
        $this->audio;    
        $url = Upload::upload($this->audio);
        
        dd(url($url));
        

        $data = Convertio::Upload($url);

        Document::create([
            'nombre' => $this->name,
            //'tiempo' => $this->formatBySegundo($data['duration']),
            'tiempo' => $this->formatBySegundo(100),
            'context' => 'hi',
            'state' => true,
            'activo' => true,
            'user_id' => Auth::user()->id,
        ]);

        $this->clear();
        $this->dispatch('update-document')->to(LivewireDocument::class);

        $this->alert('success', 'Procesando Correctamente!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }
    public function clear()
    {
        $this->name = null;
        $this->audio = null;
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