<?php

namespace App\Livewire;
 
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
 
use Livewire\Component;

class ImageUp extends Component
{
    use WithFileUploads;
    #[Validate('image|max:1024')] // 1MB Max
    public $photo;
 
    public function save()
    {
        $this->photo->store(path: 'photos');
    }
    public function render()
    {
        return view('livewire.image-up');
    }
}

 
