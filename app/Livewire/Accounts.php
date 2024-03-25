<?php

namespace App\Livewire;

use App\Models\Account;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Accounts extends Component
{
    public $accounts;
    public function mount(){
        $this->get();
    //     $this->accounts->map(function ($account){
    //         $account->avatar= $this->avatar($account->id);
            
    // return $account;
    //     });
    }
    public function get(){
        $this->accounts=Account::all();
     
    }
    // public function avatar(string $userId): string{
    //     // https://api.dicebear.com/8.x/avataaars/svg?seed=4
    //       // Choose a desired avatar style from DiceBear (e.g. bottts)
    //       $style = 'lorelei';
    //       // Base URL for DiceBear API
    //       $baseUrl = 'https://api.dicebear.com/8.x';
    //       // Use the user ID as the seed value (can be hashed for privacy)
    //       $seed = $userId;
        
    //       // Build the URL with style and seed
    //       return "$baseUrl/$style/svg?seed=$userId";
        
        
    // }
    // public function show(){
        // dd('hih');
        // $this->dispatch('show'); 
    // }
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
        //    $this->dispatch('userSucc');
           $this->close();
           $this->get();
       }
    }

    public function close(){
    
        $this->state='hidden';
        $this->reset('name','contact','idCard','address');
    }
    public function render()
    {
        return view('livewire.accounts');
    }
}
