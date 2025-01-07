<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\{
    BelongsToMany,
    HasMany
};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\StatusConstants;

class Roles extends Model
{
    use HasFactory;
    use StatusConstants;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_name',
        'description',
        'slug',
        'status'
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permissions::class, 'role_permissions', 'role_id', 'permission_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
