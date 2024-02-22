<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductEdit extends Component
{
    public $id;
    public $barcode;
    public $name;
    public $retailPrice;
    public $salePrice;
    public $qty;
    public $product;
    function mount(Product $id) {
        $this->product=$id;
        $this->name=$id->name;
        $this->qty=$id->stock_quantity;
        $this->barcode=$id->barcode;
        $this->retailPrice=$id->retail_price;
        $this->salePrice=$id->sale_price;
        // dd($this->product);
    }

  
    function discard()  {
        // dd('hi');
        return redirect()->route('stock.index');
    }
    function edit() {
       $vd= $this->validate([
            'name' => 'required',
            'barcode' => 'required',
            'retailPrice' => 'required',
            'salePrice' => 'required',
            'qty' => 'required',
        ]);
    
        // Update the product
        $this->product->update([
            'name' => $this->name,
            'barcode' => $this->barcode,
            'retail_price' => $this->retailPrice,
            'sale_price' => $this->salePrice,
            'stock_quantity' => $this->qty,
        ]);

        // Redirect to the product listing page after updating
        return redirect('/stock')->with('editSuccess', 'Product updated successfully'); 
    }

    public function render()
    {
        return view('livewire.product-edit');
    }
}
