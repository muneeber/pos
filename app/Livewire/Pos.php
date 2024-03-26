<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\CustomItem;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\Product;
use Livewire\Component;
use App\Models\SaleItem;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Cache\RateLimiting\Limit;
// use Mike42\Escpos\PrintConnectors\FilePrintConnector;
// use Mike42\Escpos\Printer;


class Pos extends Component
{
    #[Validate('required')]
    public $modal = 'hidden';
    public $barcode;
    public $name;
    public $price;
    public $totalPrice;
    public $products = [];
    public $selectedProducts = [];
    public $billSubtotal = 0;
    public $discount = 0;
    public $billTotal = 0;
    public $search = '';
    public $accounts = [];
    public $response = 'Search for Something 😋';
    public $Cproduct;
    public $Cqty;
    public $Cprice;

    // public function printBill()
    //     public function hi()
    // {
    //     $connector = new FilePrintConnector("/dev/usb/lp0"); // Update with your USB device file
    //     $printer = new Printer($connector);

    //     // Add your bill content here
    //     $printer->text("Your Bill Content Here\n");
    //     $printer->cut();

    //     $printer->close();
    // }



    public function updateQuantity($index, $qty)
    {
        $this->selectedProducts[$index]['qty'] = $qty;
        $this->selectedProducts[$index]['totalPrice'] = $this->selectedProducts[$index]['price'] * $qty;

        $this->calculateBill();
    }

    public function calculateBill()
    {
        $this->billSubtotal = collect($this->selectedProducts)->sum('totalPrice');
        $this->billTotal = $this->billSubtotal - $this->discount;
    }


    public function fbarcode()
    {
        $this->validate();
        $product = Product::where('barcode', $this->barcode)->first();
        if ($product) {

            $selectedProduct = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->sale_price,
                'qty' => 1,
                'totalPrice' => $product->sale_price
            ];
            $this->selectedProducts[] = $selectedProduct;


            $this->billSubtotal += $product->sale_price;
            $this->calculateBill();
            $this->dispatch('resetBar');
        } else {
            // $this->dispatch('barError');
            $this->dispatch('notifyError', 'Wrong  Bar Code Number');
            $this->dispatch('resetBar');
        }
    }

    public function fsearch()
    {
        if ($this->search == '*') {
            $this->products = Product::all();
        } else {
            $products = Product::where('name', 'like', '%' . $this->search . '%')->get();
            if (count($products) == 0) {
                $this->response = "Cant find any thing here 🤷‍♀️";
            }

            $this->products = $products;


            $this->calculateBill();
            $this->dispatch('resetSearch');
        }
    }

    // Helper function to find product index by ID in selectedProducts array


    function rest()
    {
        $this->selectedProducts = [];
        $this->dispatch('resetBar');
        $this->products = [];
        $this->dispatch('resetSearch');
        $this->reset('discount', 'billSubtotal', 'billTotal');
        // $this->discount=0;
        // $this->billSubtotal
        // $this->billTotal


    }
    function addProduct(Product $id)
    {
        // dd($id);
        $selectedProduct = [
            'id' => $id->id,
            'name' => $id->name,
            'price' => $id->sale_price,
            'qty' => 1,
            'totalPrice' => $id->sale_price
        ];
        $this->billSubtotal += $id->sale_price;
        // dd($selectedProduct);
        $this->products = [];
        $this->dispatch('resetSearch');

        $this->selectedProducts[] = $selectedProduct; // Append the product info to selectedProducts array
        $this->calculateBill();
    }


    #[On('discount')]
    public function discount($value)
    {
        $discount = $value;
        $limit = ($this->billSubtotal * 20) / 100;
        if ($discount <= $limit) {
            # code...
            $this->discount = $value;
            $this->billTotal = $this->billSubtotal - $value;
        } else {
            // $this->discount= $limit;
            $this->dispatch('overDiscount', ['limit' => $limit, 'discount' => $discount]);
        }
        // Debugbar::info('discount');
        // Debugbar::addMessage($value, 'success');
    }
    public function pay()
    {

        $pay = [
            'user_id' => Auth::id(),
            'sale_date' => today(),
            'subtotal' => $this->billSubtotal,
            'discount' => $this->discount,
            'total_amount' => $this->billTotal
        ];
        $sale = Sale::create($pay);

        foreach ($this->selectedProducts as $product) {
            if ($product['id'] == 'c') {
                 CustomItem::create([
                    'sale_id' => $sale->id,
                    'product_name' => $product['name'],
                    'quantity' => $product['qty'],
                    'unit_price' => $product['price']
                ]);
            } else {

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product['id'],
                    'quantity' => $product['qty'],
                    'unit_price' => $product['price']
                ]);

                $productToUpdate = Product::findOrFail($product['id']);
                $productToUpdate->decrement('stock_quantity', $product['qty']);
            }
        }

        // Reset the component state
        $this->dispatch('extras');
        $this->rest();
    }

    public function credit()
    {
        $this->accounts = (Account::all());
        $this->modal = '';
    }
    public function khata($id)
    {
        Debugbar::addMessage('success');
        if (count($this->selectedProducts) != 0) {
            # code...

            $pay = ([
                'user_id' => Auth::id(),
                'account_id' => $id,
                'sale_date' => today(),
                'subtotal' => $this->billSubtotal,
                'discount' => $this->discount,
                'status' => 'pending',
                'total_amount' => $this->billTotal
            ]);
            $sale = Sale::create($pay);
            Account::find($id)->increment('credit_balance', $this->billTotal);
            foreach ($this->selectedProducts as $product) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product['id'],
                    'quantity' => $product['qty'],
                    'unit_price' => $product['price']
                ]);
                $productToUpdate = Product::findOrFail($product['id']);
                $productToUpdate->decrement('stock_quantity', $product['qty']);
            }
            $this->modal = 'hidden';
            $this->rest();
        } else {
            Debugbar::addMessage('All Empty', 'warning');
            $this->modal = 'hidden';
            $this->rest();
            $this->dispatch('notifyError', 'No Items Selected');
        }
    }
    public function test()
    {
        dd($this->selectedProducts);
    }
    public function custom()
    {
        //  dd($this->Cproduct,$this->Cqty,$this->Cprice);
        $selectedProduct = [
            'id' => 'c',
            'name' => $this->Cproduct,
            'price' => $this->Cprice,
            'qty' => $this->Cqty,
            'totalPrice' => $this->Cqty * $this->Cprice,
        ];
        $this->billSubtotal += $this->Cprice;
        $this->selectedProducts[] = $selectedProduct; // Append the product info to selectedProducts array
        $this->reset('Cproduct', 'Cprice', 'Cqty');
        $this->dispatch('Crest');
        $this->calculateBill();
    }


    public function render()
    {
        return view('livewire.pos')->layout('layouts.posLayout');
    }
}
