<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'sale_date', 'total_amount','subtotal','discount','status'];

    public function calculateProfit()
    {
        $totalProfit = 0;

        foreach ($this->saleItems as $saleItem) {
            $totalProfit += ($saleItem->quantity * ( $saleItem->unit_price - $saleItem->product->retail_price));
        }

        return $totalProfit;
    }

    public static function totalProfitThisMonth()
    {
        $currentMonth = Carbon::now()->month;
        $totalProfitThisMonth = 0;

        $salesThisMonth = self::whereMonth('sale_date', $currentMonth)->get();

        foreach ($salesThisMonth as $sale) {
            $totalProfitThisMonth += $sale->calculateProfit();
        }

        return $totalProfitThisMonth;
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
}
