<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomItem extends Model
{
    use HasFactory;
    protected $fillable=[
       'id','sale_id','product_name','quantity','unit_price','created_at','updated_at'	
    ];
}
