<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\{BelongsTo};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Collection;

class Categories extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'status'
    ];

    public function collectionType()
    {
        return $this->belongsToMany(Collections::class, 'category_collection_types', 'category_id', 'collection_id');
    }
}
