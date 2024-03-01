<?php

namespace App\Livewire;

use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\Debugbar\Twig\Extension\Debug;
use Livewire\Component;

class Purchase extends Component
{
    public $barcode;
    public $name='Atif';
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
    public function mount()
    {
        $this->todayDate = (now()->format('Y-m-d'));
    }
    public function hi()
    {
        dd('hi');
    }
    public function show()
    {
        Debugbar::addMessage('showing input', 'success');
        $this->hide = '';
        $this->expand = 'row-span-2';
        $this->rows = 'grid-rows-2';
        $this->btnStatus = '';
    }
    public function hidde()
    {
        // dd('hi');

        Debugbar::addMessage('hiding input', 'warning');
        $this->reset('hide', 'expand', 'rows', 'btnStatus');
    }
    public function add()
    {
        if ($this->itemNPP == null && $this->itemNSP == null) {
            // Both new purchase price and new sale price are null, no changes in the database
            Debugbar::addMessage('nochange', 'success');
            $this->que($this->product->id, $this->product->name,$this->itemQty, $this->product->retail_price,$this->product->sale_price);
        } elseif ($this->itemNPP != null && $this->itemNSP != null) {
            if ($this->itemNSP > $this->itemNPP) {
                $res=$this->updatePrices($this->itemNPP, $this->itemNSP);
                if($res){
                    $this->que($this->product->id,
                    $this->product->name,
                    $this->itemQty,
                    $this->product->retail_price,
                    $this->product->sale_price);
                }
            } else {
                $this->dispatch('error','Error: New sale price must be greater than new purchase price');
                Debugbar::addMessage('Error: New sale price must be greater than new purchase price', 'error');
            }
            Debugbar::addMessage('bothChange', 'success');
        } elseif ($this->itemNPP == null && $this->itemNSP != null) {
            if ($this->itemNSP > $this->product->retail_price) {
                $res=$this->updatePrices($this->product->retail_price, $this->itemNSP);
                if($res){
                    $this->que($this->product->id,
                    $this->product->name,
                    $this->itemQty,
                    $this->product->retail_price,
                    $this->product->sale_price);
                }
            } else {
                Debugbar::addMessage('Error: New sale price must be greater than current retail price', 'error');
            }
            Debugbar::addMessage('SalePrice changed', 'success');
        } elseif ($this->itemNPP != null && $this->itemNSP == null) {
            if ($this->itemNPP <= $this->product->sale_price) {
                $res=$this->updatePrices($this->itemNPP, $this->product->sale_price);
                if($res){
                    $this->que($this->product->id,
                    $this->product->name,
                    $this->itemQty,
                    $this->product->retail_price,
                    $this->product->sale_price);
                }
            } else {
                Debugbar::addMessage('Error: New purchase price must be less than or equal to current sale price', 'error');
            }
            Debugbar::addMessage('PurchsePrice changed', 'success');
        }
    }
    
    // Method to update purchase and sale prices in the database
    private function updatePrices($newPurchasePrice, $newSalePrice)
    {
        // Update the database with new purchase price and new sale price
         $res=Product::find($this->product->id)->update(['retail_price' => $newPurchasePrice, 'sale_price' => $newSalePrice]);
        $this->product=Product::find($this->product->id);
        // dd($this->product);
        return $res;
    }
    
    public function que($id,$name,$qty,$pp,$sp)
    {
        $this->selectedProducts[]=[
            'id'=>$id,
            'name'=>$name,
            'qty'=>$qty,
            'pp'=>$pp,
            'sp'=>$sp
        ];
        
        $this->dispatch('new');
        $this->reset('itemQty','barcode','product','itemNPP','itemNSP');
        $this->hidde();
    }
    public function item()
    {
        $item = Product::where('barcode', $this->barcode)->get();
        foreach ($item as  $product) {
            $this->product = $product;
        }
        // $this->itemName=($item[0]->name);
        // $this->itemSP=($item[0]->sale_price);
        // $this->itemPP=($item[0]->retail_price);

    }
    public function render()
    {
        return view('livewire.purchase');
    }
}
