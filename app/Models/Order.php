<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_phone',
        'address',
        'service_name',
        'estimated_weight',
        'pickup_date',
        'pickup_time',
        'total_price',
        'status',
        'order_type'
    ];
}