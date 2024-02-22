<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Stock extends Component
{
    // #[Validate(['required'])]
    public $search;
    public $status;
    public $products;
    public $results;
    function mount()  {
     $this->restore();
    }

    function restore() {
        $this->products=Product::all();
        $this->results=(count($this->products));
    }

    function scope()  {
        if ($this->status == "All Stock") {
            $products = Product::all(); // Retrieve all products
        } elseif ($this->status == "In Stock") {
            $products = Product::where('stock_quantity', '>', 0)->get(); // Retrieve products with stock_quantity greater than 0
        } elseif ($this->status == "Out Stock + Almost End") {
            $products = Product::where('stock_quantity', '=', 0)->orWhere('stock_quantity', '<', 9)->get(); // Retrieve products with stock_quantity equals to 0 or less than 9
        } elseif ($this->status == "Out Stock") {
            $products = Product::where('stock_quantity', '=', 0)->get(); // Retrieve products with stock_quantity equals to 0
        } elseif ($this->status == "Almost End") {
            $products = Product::where('stock_quantity', '>', 0)->where('stock_quantity', '<', 9)->get(); // Retrieve products with stock_quantity greater than 0 and less than 9
        }
        $this->products=$products;
        $this->results=(count($this->products));

    }
    function hi() {
        dd('hi');
    }

    function delete($id) {
        $result=Product::find($id)->delete();
        if ($result) {
            $this->restore();
            $this->dispatch('barError'); 

        }
    }


    
 
    public function fsearch(){
        // $this->validate();
        // dd($this->search);
        if ($this->search!='') {
            # code...
            $this->products = Product::where('name', 'like', '%' . $this->search . '%')->get();
            $this->results=(count($this->products));
        }else{
            $this->restore();
        }

       
    }


    public function render()
    {
        return view('livewire.stock');
    }
}
