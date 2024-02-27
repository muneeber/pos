<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Sale;
use Livewire\Component;

class SalesChart extends Component
{
    public $salesData = [];
    public $dates = [];

    public function mount()
    {
        // Retrieve sales data and corresponding dates for the last two weeks
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subDays(14);
        $sales = Sale::whereBetween('sale_date', [$startDate, $endDate])->where('status','completed')
            ->orderBy('sale_date')
            ->get();

        // Populate the sales data and dates arrays
        // Populate the sales data and dates arrays
        foreach ($sales as $sale) {
            // Convert sale_date string to Carbon instance
            $saleDate = Carbon::parse($sale->sale_date);
            // Format the date
            $this->dates[] = $saleDate->format('d F');
            // Populate the sales data array
            $this->salesData[] = $sale->total_amount;
        }
    }
    public function render()
    {
        return view('livewire.sales-chart');
    }
}
