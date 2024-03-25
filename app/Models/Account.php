<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'Name',
        'Contact',
        'id_card',
        'credit_balance',
        'Address',
    ];
    public function sales():HasMany
    {
        return $this->hasMany(Sale::class, 'account_id');
    }
}
