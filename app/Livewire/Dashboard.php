<?php

namespace App\Livewire;

use App\Models\Sale;
use Livewire\Component;
use Illuminate\Support\Carbon;

class Dashboard extends Component
{
    public $sales;
    public $todaySale;
    public $monthlySale;
    public $pr;
    public function mount()
    {
        $this->sales = $this->getNumberOfSalesToday();
        $this->todaySale = $this->getTotalSalesAmountToday();
        $this->monthlySale = $this->getTotalSalesAmountThisMonth();
    }
  
    function getNumberOfSalesToday()
    {
        // Get the current date
        $today = Carbon::today();

        // Query the Sale model to count the sales that happened today
        $numberOfSales = Sale::whereDate('sale_date', $today)->count();

        return $numberOfSales;
    }
    function getTotalSalesAmountToday()
    {
        // Get the current date
        $today = Carbon::today();

        // Query the Sale model to sum up the total_amount of sales that happened today
        $totalSalesAmount = Sale::whereDate('sale_date', $today)->sum('total_amount');

        $formattedAmount = number_format($totalSalesAmount, 0);

    return $formattedAmount;
    }

    function getTotalSalesAmountThisMonth()
    {
        // Get the current month and year
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Query the Sale model to sum up the total_amount of sales for the current month
        $totalSalesAmount = Sale::whereYear('sale_date', $currentYear)
            ->whereMonth('sale_date', $currentMonth)
            ->sum('total_amount');

        $formattedAmount = number_format($totalSalesAmount, 0);

        return $formattedAmount;
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
