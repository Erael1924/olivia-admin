<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Category,
    Collection,
    Discounts,
    Products
};

class DiscountedProducts extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'discount_id',
        'discountable_id',
        'discountable_type'
    ];

    public function discount(): BelongsTo
    {
        return $this->belongsTo(Discounts::class, 'discount_id');
    }

}
