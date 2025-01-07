<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'collection_id',
        'category_id',
        'sub_category_id',
        'tags',
        'status',
        'weight',
        'width',
        'length',
        'height',
        'has_variant',
        'price',
        'stock'
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collections::class, 'collection_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategories::class, 'sub_category_id');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariants::class, 'product_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(ProductDetails::class, 'product_id');
    }
}
