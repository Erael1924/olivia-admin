<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Orders;

class ShippingOptions extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'carrier',
        'service_level',
        'estimated_delivery_time',
        'handling_fee',
        'is_international'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Orders::class, 'payment_method_id');
    }
}
