<?php

namespace App\Livewire;

use App\Models\Sale;
use Livewire\Component;

class Sales extends Component
{
    public $startDate;
    public $endDate;
    public $sales;
    public $today;
    public $status;
    public function mount(){
        $today = now();
    $this->endDate = $today->format('Y-m-d'); // Set end date as today
    
    // Calculate three days before today
    $this->startDate = $today->subDays(3)->format('Y-m-d');
    
    // Fetch sales data within the specified date range
    $this->sales = Sale::whereBetween('sale_date', [$this->startDate, $this->endDate])->get()->map(function ($sale) {
        $sale->profit = $sale->calculateProfit();
        return $sale;
    });
    }
    public function byDate(){
        $this->sales = Sale::whereBetween('sale_date', [$this->startDate, $this->endDate])->get()->map(function ($sale) {
            $sale->profit = $sale->calculateProfit();
            return $sale;
        });
    }
    public function byStatus(){
        $this->sales = Sale::where('status',$this->status)->get()->map(function ($sale) {
            $sale->profit = $sale->calculateProfit();
            return $sale;
        });
    }
    public function render()
    {
        return view('livewire.sales');
    }
}
