<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Orders extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_number',
        'customer_id',
        'customer_name',
        'customer_address',
        'customer_city',
        'customer_province',
        'customer_zipcode',
        'payment_method_id',
        'shipping_option_id',
        'subtotal',
        'voucher_discount',
        'shipping_fee',
        'shipping_discount',
        'shipping_discount_type',
        'total_amount',
        'status',
        'tracking_number',
        'voucher_id',
        'paid_at',
        'shipped_at',
        'delivered_at',
        'cancelled_at'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class, 'customer_id');
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethods::class, 'payment_method_id');
    }

    public function shippingOption(): BelongsTo
    {
        return $this->belongsTo(ShippingOptions::class, 'shipping_option_id');
    }

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Vouchers::class, 'voucher_id');
    }
}
