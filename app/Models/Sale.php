<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'sale_date','name', 'total_amount','subtotal','discount','status','payment_method',
    'account_id'];

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

        $salesThisMonth = self::whereMonth('sale_date', $currentMonth)->where('status','completed')->get();

        foreach ($salesThisMonth as $sale) {
            $totalProfitThisMonth += $sale->calculateProfit();
        }

        return $totalProfitThisMonth;
    }
    
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function saleItems():HasMany
    {
        return $this->hasMany(SaleItem::class);
    }
    public function account():BelongsTo
    {
        return $this->belongsTo(Account::class);
    }
}
