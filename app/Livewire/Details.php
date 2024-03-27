<?php

namespace App\Livewire;

use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use App\Models\Purchase;

class Details extends Component
{
    public $table;
    public $id;
    public $data;
    public $items = [];

    public function mount($table, $id)
    {
        $this->table = $table;
        $this->id = $id;
        if ($table == 'sale') {
            # code...
            $this->data = (Sale::with('saleItems', 'user')->find($id));
            $this->items = ($this->data->saleItems);
            $this->items->map(function ($item) {
                $prod = Product::find($item->product_id);
                $item->name = $prod->name;
                $item->quantity_purchased=$item->quantity;
                $item->price=$item->unit_price;
                $item->totalPrice = $item->unit_price*$item->quantity;
    
                return $item;
            });
        } else {

            $this->data = (Purchase::with('purchaseItems', 'user')->find($id));
            $this->items = ($this->data->purchaseItems);
            $this->items->map(function ($item) {
                $prod = Product::find($item->product_id);
                $item->name = $prod->name;
                $item->price = $prod->retail_price;
                
                $item->totalPrice = $prod->retail_price * $item->quantity_purchased;
    
                return $item;
            });
        }

       
        // dd($this->items);
    }
    public function render()
    {
        return view('livewire.details');
    }
}
