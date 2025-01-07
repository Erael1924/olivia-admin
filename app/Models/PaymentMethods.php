<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Orders;

class PaymentMethods extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'method_name',
        'payment_gateway',
        'type',
        'logo_url',
        'transaction_fee'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Orders::class, 'payment_method_id');
    }
}
