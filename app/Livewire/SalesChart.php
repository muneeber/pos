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
        $sales = Sale::whereBetween('sale_date', [$startDate, $endDate])
            ->where('status', 'completed')
            ->orderBy('sale_date')
            ->get();
    
        // Group sales by date and calculate total sales for each date
        $salesByDate = $sales->groupBy(function ($sale) {
            return Carbon::parse($sale->sale_date)->format('Y-m-d');
        });
    
        // Populate the sales data and dates arrays
        foreach ($salesByDate as $date => $sales) {
            // Calculate total sales for this date
            $totalSales = $sales->sum('total_amount');
            // Format the date
            $formattedDate = Carbon::parse($date)->format('d F');
            // Populate the sales data array
            $this->dates[] = $formattedDate;
            // Populate the total sales data array
            $this->salesData[] = $totalSales;
        }
    }
    
    public function render()
    {
        return view('livewire.sales-chart');
    }
}
