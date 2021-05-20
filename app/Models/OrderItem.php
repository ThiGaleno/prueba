<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'unit_price',
        'discount_product',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
