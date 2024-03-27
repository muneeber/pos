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
    public $sumSubTotal = 0;
    public $sumTotal = 0;
    public $sumProfit = 0;
    public $status;

    public function mount()
    {
        $today = now();
        $this->endDate = $today->format('Y-m-d'); // Set end date as today

        // Calculate three days before today
        $this->startDate = $today->subDays(3)->format('Y-m-d');

        // Fetch sales data within the specified date range
        $this->sales = Sale::with('account','user')->whereBetween('sale_date', [$this->startDate, $this->endDate])->orderBy('updated_at', 'desc')->get()->map(function ($sale) {
            $sale->profit = $sale->calculateProfit();

            // Increment sum of subtotal, total, and profit
            $this->sumSubTotal += $sale->subtotal;
            $this->sumTotal += $sale->total_amount;
            $this->sumProfit += $sale->profit;

            return $sale;
        });
        // dd($this->sales);
    }

    public function byDate()
    {
        $this->sales = Sale::with('account','user')->whereBetween('sale_date', [$this->startDate, $this->endDate])->orderBy('updated_at', 'desc')->get()->map(function ($sale) {
            $sale->profit = $sale->calculateProfit();

            // Increment sum of subtotal, total, and profit
            $this->sumSubTotal += $sale->subtotal;
            $this->sumTotal += $sale->total_amount;
            $this->sumProfit += $sale->profit;

            return $sale;
        });
    }

    public function byStatus()
    {
        $this->sales = Sale::with('account','user')->where('status', $this->status)->orderBy('updated_at', 'desc')->get()->map(function ($sale) {
            $sale->profit = $sale->calculateProfit();

            // Increment sum of subtotal, total, and profit
            $this->sumSubTotal += $sale->subtotal;
            $this->sumTotal += $sale->total_amount;
            $this->sumProfit += $sale->profit;

            return $sale;
        });
    }

    public function render()
    {
        return view('livewire.sales');
    }
}
