<?php

namespace App\Livewire;

use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use App\Models\SaleItem;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Cache\RateLimiting\Limit;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\Debugbar\Twig\Extension\Debug;

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
    public $discount=0;
    public $billTotal=0;


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
                $this->calculateBill();
            }
    
            $this->dispatch('resetBar'); 
        } else {
            $this->dispatch('barError'); 
            $this->dispatch('resetBar'); 
        }
    }
    
    public function updateQuantity($index, $qty){
        $this->selectedProducts[$index]['qty'] = $qty;
        $this->selectedProducts[$index]['totalPrice'] = $this->selectedProducts[$index]['price'] * $qty;

        $this->calculateBill();
    }

    public function calculateBill(){
        $this->billSubtotal = collect($this->selectedProducts)->sum('totalPrice');
        $this->billTotal = $this->billSubtotal - $this->discount;
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
        $this->reset('discount','billSubtotal','billTotal');
        // $this->discount=0;
        // $this->billSubtotal
        // $this->billTotal


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
        $this->calculateBill();
        $this->products=[];
        $this->dispatch('resetSearch'); 

        $this->selectedProducts[] = $selectedProduct; // Append the product info to selectedProducts array

    }
    #[On('discount')] 
    public function discount($value)
    {
        $discount=$value;
        $limit=($this->billSubtotal*20)/100;
        if ($discount<=$limit) {
            # code...
            $this->discount= $value;
            $this->billTotal=$this->billSubtotal-$value;
        }
        else{
            // $this->discount= $limit;
            $this->dispatch('overDiscount', ['limit'=> $limit, 'discount'=>$discount ]); 
        }
        // Debugbar::info('discount');
        // Debugbar::addMessage($value, 'success');
    }

    function pay() {
        $pay=([
            'user_id'=> Auth::id(),
            'sale_date' => today() ,
            'subtotal' =>$this->billSubtotal,
            'discount' => $this->discount,
            'total_amount'=> $this->billTotal
        ]);
        $sale =Sale::create($pay);
        foreach ($this->selectedProducts as $product) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $product['id'],
                'quantity' => $product['qty'],
                'unit_price' => $product['price']
            ]);
             // Update product quantity
        $productToUpdate = Product::findOrFail($product['id']);
        $productToUpdate->decrement('stock_quantity', $product['qty']);
        }
        $this->dispatch('extras');
        $this->rest();
    }
    function hold() {
        
        $pay=([
            'user_id'=> Auth::id(),
            'sale_date' => today() ,
            'status'=>'pending',
            'subtotal' =>$this->billSubtotal,
            'discount' => $this->discount,
            'total_amount'=> $this->billTotal
        ]);
        $sale=Sale::create($pay);
        foreach ($this->selectedProducts as $product) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'product_id' => $product['id'],
                'quantity' => $product['qty'],
                'unit_price' => $product['price']
            ]);
        }
        $this->dispatch('hold');
        $this->rest();
    }
    public function render()
    {
        return view('livewire.pos')->layout('layouts.posLayout');
    }
}
