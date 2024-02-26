<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Pos extends Component
{
    #[Validate('required')]
    public $barcode;
    public $name;
    public $price;
    public $totalPrice;
    public $products=[];
    public $selectedProducts=[];
    public $billSubtotal=0;


    function fbarcode() {
        $this->validate();
        $product = Product::where('barcode', $this->barcode)->get();
        if (count($product) > 0) {
            // Loop through each product and store its information
            foreach ($product as $prod) {
                $this->billSubtotal+= $prod->sale_price;
                $selectedProduct = [
                    'id' => $prod->id,
                    'name' => $prod->name,
                    'price' => $prod->sale_price,
                    'qty' => 1,
                    'totalPrice' => $prod->sale_price
                ];
                // dd($selectedProduct['id']);
                $this->selectedProducts[] = $selectedProduct; // Append the product info to selectedProducts array
                // dd($this->selectedProducts);

            }
    
            $this->dispatch('resetBar'); 
        } else {
            $this->dispatch('barError'); 
            $this->dispatch('resetBar'); 
        }
    }
    

    public $search = '';
 
    public function fsearch(){
        $this->products = Product::where('name', 'like', '%' . $this->search . '%')->get();
       
    }
  

    function rest()  {
        $this->selectedProducts=[];
        $this->dispatch('resetBar'); 
        $this->products=[];
        $this->dispatch('resetSearch'); 


    }
    function addProduct(Product $id){
        // dd($id);
        $selectedProduct = [
            'id' => $id->id,
            'name' => $id->name,
            'price' => $id->sale_price,
            'qty' => 1,
            'totalPrice' => $id->sale_price
        ];
        $this->billSubtotal+=$id->sale_price;
        // dd($selectedProduct);
        $this->products=[];
        $this->dispatch('resetSearch'); 

        $this->selectedProducts[] = $selectedProduct; // Append the product info to selectedProducts array

    }

    function changeQty($index) {
        $this->dispatch("changeQty");
    }


    public function render()
    {
        return view('livewire.pos')->layout('layouts.posLayout');
    }
}
