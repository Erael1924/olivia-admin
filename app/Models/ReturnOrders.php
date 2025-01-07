<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnOrders extends Model
{
    use HasFactory;

    protected $fillable = [
        'return_number',
        'order_id',
        'customer_name',
        'customer_address',
        'customer_city',
        'customer_province',
        'customer_zipcode',
        'return_type', // e.g., 'return_only', 'return_refund'
        'message',
        'refund_amount',
        'status',
        'tracking_number',
        'approved_at',
        'shipped_at',
        'completed_at'
    ];
}
