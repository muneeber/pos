<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;

class Doc extends Component 
{
    use WithFileUploads;
 
    // #[Validate('image|max:1024')] // 1MB Max
    public $image;
    public $path;
    public $imageUrl;

    public function mount(){
        Storage::disk('local')->url('photos/hi.jpg');
    }
    public function save()
    {
        // dd($this->image);
        if ($this->image!= null) {
            # code...
            $hi=$this->path=$this->image->store(path: 'photos');
            // dd($hi);
        }
        else{
            $this->dispatch('notifyError', 'Null');
        }
    }

    public function render()
    {
        return view('livewire.doc');
    }
}
