<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Pos extends Component
{
    #[Validate('required')]
    public $barcode;
    public $state='hidden';
    public $name;
    public $price;
    public $totalPrice;
    public $products=[];
    function fbarcode() {
        $this->validate();
        $product = Product::where('barcode', $this->barcode)->get();
        if (count($product)>0) {
            
            $this->state="flex"; 
            $this->name=($product[0]->name);
            $this->price=($product[0]->sale_price);
            $this->dispatch('resetBar'); 
        }
        else{
            
        $this->dispatch('barError'); 
        $this->dispatch('resetBar'); 
        }
    }
    function hi() {
        dd('hi');
    }

    public $search = '';
 
    public function fsearch(){
        $this->products = Product::where('name', 'like', '%' . $this->search . '%')->get();
       
    }

    public function render()
    {
        return view('livewire.pos')->layout('layouts.posLayout');
    }
}
