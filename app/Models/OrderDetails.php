<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\{
    Orders,
    Products
};

class OrderDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'primary_variant_option',
        'secondary_variant_option',
        'product_name',
        'item_price',
        'discount',
        'quantity',
        'total'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
