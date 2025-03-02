<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Roles,
    Permissions
};

class RolePermissions extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'permission_id'
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }

    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permissions::class, 'permission_id');
    }
}
