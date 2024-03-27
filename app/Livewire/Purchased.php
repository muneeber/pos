<?php
namespace App\Livewire;
use App\Models\Product;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facades\Debugbar;
use DebugBar\DebugBar as DebugBarDebugBar;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use PhpParser\Node\Stmt\Foreach_;

class Purchased extends Component
{
    public $barcode;
    public $name;
    public $todayDate;
    public $itemNPP;
    public $itemNSP;
    public $itemQty;
    public $product;
    public $hide = 'hidden';
    public $expand;
    public $rows = 'grid-rows-1';
    public $btnStatus = 'hidden';
    public $selectedProducts = [];
    public $total_amount=0;
    public $place='purchase';
    public $state='hidden';
    public function mount()
    {
        $this->todayDate = (now()->format('Y-m-d'));
        $this->name=Auth::user()->name;
        // dd($this->name);
    }
    public function show()
    {
        Debugbar::addMessage('showing input', 'success');
        $this->hide = '';
        $this->expand = 'row-span-2';
        $this->rows = 'grid-rows-2';
        $this->btnStatus = '';
    }
    public function showadd(){
     $this->state='';
    }
    public function hidde()
    {
        Debugbar::addMessage('hiding input', 'warning');
        $this->reset('hide', 'expand', 'rows', 'btnStatus');
    }
    public function closeadd(){
     $this->state='hidden';
    }
    public function add()
    {
        if ($this->itemNPP == null && $this->itemNSP == null) {
            Debugbar::addMessage('nochange', 'success');
            $this->que($this->product->id, $this->product->name, $this->itemQty, $this->product->retail_price, $this->product->sale_price);
        } elseif ($this->itemNPP != null && $this->itemNSP != null) {
            if ($this->itemNSP > $this->itemNPP) {
                $res = $this->updatePrices($this->itemNPP, $this->itemNSP);
                if ($res) {
                    $this->que(
                        $this->product->id,
                        $this->product->name,
                        $this->itemQty,
                        $this->product->retail_price,
                        $this->product->sale_price
                    );
                }
            } else {
                $this->dispatch('error', 'Error: New sale price must be greater than new purchase price');
                Debugbar::addMessage('Error: New sale price must be greater than new purchase price', 'error');
            }
            Debugbar::addMessage('bothChange', 'success');
        } elseif ($this->itemNPP == null && $this->itemNSP != null) {
            if ($this->itemNSP > $this->product->retail_price) {
                $res = $this->updatePrices($this->product->retail_price, $this->itemNSP);
                if ($res) {
                    $this->que(
                        $this->product->id,
                        $this->product->name,
                        $this->itemQty,
                        $this->product->retail_price,
                        $this->product->sale_price
                    );
                }
            } else {
                Debugbar::addMessage('Error: New sale price must be greater than current retail price', 'error');
            }
            Debugbar::addMessage('SalePrice changed', 'success');
        } elseif ($this->itemNPP != null && $this->itemNSP == null) {
            if ($this->itemNPP <= $this->product->sale_price) {
                $res = $this->updatePrices($this->itemNPP, $this->product->sale_price);
                if ($res) {
                    $this->que(
                        $this->product->id,
                        $this->product->name,
                        $this->itemQty,
                        $this->product->retail_price,
                        $this->product->sale_price
                    );
                }
            } else {
                Debugbar::addMessage('Error: New purchase price must be less than or equal to current sale price', 'error');
            }
            Debugbar::addMessage('PurchsePrice changed', 'success');
        }
    }
    private function updatePrices($newPurchasePrice, $newSalePrice)
    {
        $res = Product::find($this->product->id)->update(['retail_price' => $newPurchasePrice, 'sale_price' => $newSalePrice]);
        $this->product = Product::find($this->product->id);
        return $res;
    }
    public function que($id, $name, $qty, $pp, $sp)
    {
        $this->selectedProducts[] = [
            'id' => $id,
            'name' => $name,
            'qty' => $qty,
            'pp' => $pp,
            'sp' => $sp
        ];
        $this->dispatch('new');
        $this->reset('itemQty', 'barcode', 'product', 'itemNPP', 'itemNSP');
        $this->hidde();
        $this->totalAmount();
    }
    public function totalAmount(){
    foreach ($this->selectedProducts as $key => $value) {
        # code...
       $this->total_amount+= $value['qty']*$value['sp'];
    }
    }
    public function item()
    {
        $item = Product::where('barcode', $this->barcode)->get();
        foreach ($item as  $product) {
            $this->product = $product;
        }
    }
    public function submit()
{
    DebugBar::addMessage('Submittin','info');
    DebugBar::addMessage($this->total_amount,'info');
    // dd($this->total_amount);
    // Validate total amount (assuming it's calculated elsewhere)
    if (count($this->selectedProducts)==0) {
        $this->dispatch('notifyError', 'No product added or selected');
    }
    $this->validate([
        'total_amount' => 'required|numeric|min:0',
        'todayDate'=>'required',
        'selectedProducts'=>'required'

    ]);
    // Create a new Purchase record
    $purchase = Purchase::create([
        'user_id' => auth()->id(), // Assuming you have user authentication
        'purchase_date' => $this->todayDate,
        'total_amount' => $this->total_amount,
    ]);

    // Loop through selected products and save them in Purchase_items table
    foreach ($this->selectedProducts as $item) {
        PurchaseItem::create([
            'purchase_id' => $purchase->id,
            'product_id' => $item['id'],
            'quantity_purchased' => $item['qty'],
        ]);
        $productToUpdate = Product::findOrFail($item['id']);
        $productToUpdate->increment('stock_quantity', $item['qty']);
    }

    // Clear selected products and display success message
    $this->selectedProducts = [];
    $this->rest();
    // $this->dispatchBrowserEvent('purchase-saved'); // You can define a custom event to handle success in your view
    DebugBar::addMessage('Gotit','success');
}
public function rest(){
    $this->dispatch('reset');
 $this->reset('barcode','name','todayDate','itemNPP','itemNSP','itemQty','product','hide','expand','rows','btnStatus','selectedProducts','total_amount');
 
}
    public function render()
    {
        return view('livewire.purchased');
    }
}
