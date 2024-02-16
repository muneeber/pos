<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'purchase_date', 'total_amount', 'supplier', 'notes'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function purchaseItems():HasMany
    {
        return $this->hasMany(PurchaseItem::class);
    }
}
