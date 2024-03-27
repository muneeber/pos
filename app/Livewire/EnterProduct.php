<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Validate;

class EnterProduct extends Component
{
    #[Validate('required|unique:products')]
    public $barcode = '';
    #[Validate('required|min:3')]
    public $name = '';
    // #[Validate('required|numeric')]
    public $qty = 0;
    #[Validate('required|numeric')]
    public $salePrice = '';
    #[Validate('required|numeric')]
    public $retailPrice = '';
    public $place;
    public $shelf;
    public $category;
    public $categories;
    public $company;
    // public $test="hi";
    public function mount($place='')
    {
        // $this->place=$place;
        // dd($place);
       $this->categories=(Category::all());
    }

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
                "company" => $this->company,
                "shelf" => $this->shelf,
                "category_id" => $this->category,
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
        } else {
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
        $this->resetValidation();
    }
    public function render()
    {
        return view('livewire.enter-product');
    }
}
