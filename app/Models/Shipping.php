<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    /** @use HasFactory<\Database\Factories\ShippingFactory> */
    use HasFactory;


    protected $fillable = [
        'order_id',
        'carrier',
        'status',
        'estimated_delivery'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
