<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;

    public function children(): HasMany
    {
        return $this->hasMany(Permissions::class, 'parent_id')->with('children');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Permissions::class, 'parent_id');
    }

    public function descendants()
    {
        return $this->children()->with('descendants');
    }
}
