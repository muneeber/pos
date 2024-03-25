<?php

namespace App\Livewire;

use App\Models\Account;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class AccountModal extends Component
{
    public $state='hidden';
    #[Validate('required|string|max:255')]
    public $name;
    #[Validate('required|string|min:11')]
    public $contact;
    #[Validate('required|string')]
    public $address;
    #[Validate('required|string|min:12')]
    public $idCard;

    #[On('show')] 
    public function show(){
    $this->state='';
        // dd('hih');

    }
    public function submit(){
       $this->validate();
       $customer=[
        'Name'=>$this->name,
        'Contact'=>$this->contact,
        'id_card'=>$this->idCard,
        'Address'=>$this->address
       ];
       $response=Account::create($customer);
       if ($response) {
           $this->dispatch('userSucc');
           $this->close();
       }
    }
    public function close(){
    
        $this->state='hidden';
        $this->reset('name','contact','idCard','address');
    }
    public function render()
    {
        return view('livewire.account-modal');
    }
}
