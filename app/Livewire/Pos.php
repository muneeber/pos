<?php

namespace App\Livewire;

use App\Models\Account;
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
    public $accounts=[];
    public $response = 'Search for Something 😋';

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
        // Check if the sale has already been restored
        
            // Create a new sale record
            $pay = [
                'user_id' => Auth::id(),
                'sale_date' => today(),
                'subtotal' => $this->billSubtotal,
                'discount' => $this->discount,
                'total_amount' => $this->billTotal
            ];
            $sale = Sale::create($pay);
    
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

        // Reset the component state
        $this->dispatch('extras');
        $this->rest();
    }

    public function credit(){
        $this->accounts=(Account::all());
        $this->modal='';
    }
    public function khata($id){
        Debugbar::addMessage('success');
        if (count($this->selectedProducts)!=0) {
        # code...
        
        $pay = ([
            'user_id' => Auth::id(),
            'account_id'=>$id,
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
        $this->modal='hidden';
        $this->rest();
        }
        else{
        Debugbar::addMessage('All Empty','warning');
        $this->modal='hidden';
        $this->rest();
        $this->dispatch('notifyError', 'No Items Selected');
        }
    }
    
    public function render()
    {
        return view('livewire.pos')->layout('layouts.posLayout');
    }
}


// ----------------------------------------------------------------------------------------------------------------------




// function hold()
    // {
        // Debugbar::addMessage('Check1', 'success');
        // if (count($this->selectedProducts) != 0) {
        //     Debugbar::addMessage('Check2', 'success');

        //     $this->dispatch('hold');
        // } else {
        //     Debugbar::addMessage('Check3', 'success');
        //     // $this->dispatch('notifyError', 'No Products Added');
        //     $this->dispatch('modalError', 'No Products Added');
        // }
    // }
    // #[On('holdName')]
    // public function holdName($name)
    // {
    //     // Debugbar::addMessage($name,'success');
    //     // if (count($this->selectedProducts)!=0) {
    //     # code...
    //     $pay = ([
    //         'user_id' => Auth::id(),
    //         'sale_date' => today(),
    //         'status' => 'pending',
    //         'name' => $name,
    //         'subtotal' => $this->billSubtotal,
    //         'discount' => $this->discount,
    //         'total_amount' => $this->billTotal
    //     ]);
    //     $sale = Sale::create($pay);
    //     foreach ($this->selectedProducts as $product) {
    //         SaleItem::create([
    //             'sale_id' => $sale->id,
    //             'product_id' => $product['id'],
    //             'quantity' => $product['qty'],
    //             'unit_price' => $product['price']
    //         ]);
    //     }
    //     $this->rest();
    //     // }
    //     // else{
    //     // Debugbar::addMessage('All Empty','warning');
    //     // }
    // }

    // public function orders()
    // {
    //     $threeDaysAgo = Carbon::now()->subDays(3);
    //     $sales = Sale::where('status', 'pending')
    //         ->where('sale_date', '>=', $threeDaysAgo)
    //         ->orderBy('created_at', 'desc')
    //         ->get();
    //     $this->pendingOrders = ($sales);
    //     $this->modal = '';
    // }

    // public function restoreOrder($id)
    // {
    //     // dd($id);

    //     // Retrieve the sale by its ID
    //     $sale = Sale::findOrFail($id);
    //     $this->restoredSaleId = $id;

    //     // Retrieve the sale items associated with the sale
    //     $saleItems = SaleItem::where('sale_id', $id)->get();

    //     // Add the sale items back to the selected products list
    //     foreach ($saleItems as $saleItem) {
    //         $product = Product::findOrFail($saleItem->product_id);

    //         $selectedProduct = [
    //             'id' => $product->id,
    //             'name' => $product->name,
    //             'price' => $product->sale_price,
    //             'qty' => $saleItem->quantity,
    //             'totalPrice' => $saleItem->unit_price * $saleItem->quantity
    //         ];

    //         $this->selectedProducts[] = $selectedProduct;
    //     }
    //     $this->saleRestored = true;

    //     // Recalculate the bill
    //     $this->calculateBill();
    //     $this->modal = 'hidden';

    //     // Update the UI or perform any additional actions as needed
    // }

   

    