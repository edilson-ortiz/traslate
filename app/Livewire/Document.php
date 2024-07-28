<?php

namespace App\Livewire;

use App\Models\Document as ModelsDocument;
use App\Services\Convertio;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Laravel\Jetstream\InteractsWithBanner;

class Document extends Component
{
    use WithPagination;
    use LivewireAlert;
    use InteractsWithBanner;
    public $search = '';
    public $confirmingUserDeletion = false;
    public $updateModal;
    public $select_id;

    #[On('update-document')]
    public function render()
    {
        $documents = ModelsDocument::where('user_id', Auth::user()->id)
            ->where('activo','1')
            ->where(function ($query) {
                $query->where('nombre', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(3);

        return view('livewire.document', ['documents' => $documents]);
    }

    public function confirModal($id)
    {
        $this->confirmingUserDeletion  = true;
        $this->select_id = $id;
    }

    public function deleteDocumento()
    {
        $documents = ModelsDocument::find($this->select_id);
        if ($documents) {
            $documents->activo=0;
            $documents->update();
        }
        $this->alert('success', 'Eliminado Correctamente!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);

        $this->confirmingUserDeletion  = false;
    }

    public function openModal()
    {
        $this->updateModal = true;
    }

    public function procesar($id)
    {     
        $data = $documents = ModelsDocument::find($id);    
        $response = Convertio::Upload($data->url);
        $data->context = $response['transcript'];
        $data->tiempo = $this->formatBySegundo($response['duration']);
        $data->state = true;
        $data->update();

        $this->alert('success', 'Procesado correctamente!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function formatBySegundo($seg)
    {
        $hours = floor($seg / 3600);
        $minutes = floor(($seg % 3600) / 60);
        $seconds = $seg % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }
}