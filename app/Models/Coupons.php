<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    /** @use HasFactory<\Database\Factories\CouponsFactory> */
    use HasFactory;
    protected $fillable = [
        'code',
        'discount',
        'min_order_value',
        'expiration_date'
    ];

    protected $casts = [
        'discount' => 'integer',
    ];
}
