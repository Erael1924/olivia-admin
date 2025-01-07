<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Products,
    ProductVariantImages,
    Variants
};

class ProductVariants extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'sku',
        'first_option',
        'second_option',
        'stock',
        'price',
        'level',
        'status'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductVariantImages::class, 'product_variant_id');
    }
}
