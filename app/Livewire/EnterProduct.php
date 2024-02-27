<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Validate;

class EnterProduct extends Component
{
    #[Validate('required|unique:products')]
    public $barcode = '';
    #[Validate('required|min:3')]
    public $name = '';
    #[Validate('required|numeric')]
    public $qty = '';
    #[Validate('required|numeric')]
    public $salePrice = '';
    #[Validate('required|numeric')]
    public $retailPrice = '';

    // public $test="hi";

    public function save()
    {
        // dd('hi');
        $this->validate();
        if ($this->salePrice >= $this->retailPrice) {
            # code...

            $vd = [
                "barcode" => $this->barcode,
                "name" => $this->name,
                "stock_quantity" => $this->qty,
                "sale_price" => $this->salePrice,
                "retail_price" => $this->retailPrice,
            ];
            // dd($vd);
            $response = Product::create($vd);

            if ($response) {
                // return redirect()->back()->with("success","Product Entered Succesfully.");
                // $this->reset("name","barcode","qty","salePrice","retailPrice");
                $this->barcode = '';
                $this->name = '';
                $this->qty = '';
                $this->salePrice = '';
                $this->retailPrice = '';
                // $this->test="by";
                $this->dispatch("productCreated");
                // dd('done');
            }
        }
        else{
            $this->dispatch("priceError");
            $this->addError('salePrice', 'Sale Price should be geater or equal to retail price.');
        }
    }
    function formReset()
    {
        $this->barcode = '';
        $this->name = '';
        $this->qty = '';
        $this->salePrice = '';
        $this->retailPrice = '';
    }
    public function render()
    {
        return view('livewire.enter-product');
    }
}
