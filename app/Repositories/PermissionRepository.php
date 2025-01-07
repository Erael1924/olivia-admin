<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use App\Models\Permissions;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function allGrouped()
    {
        $permissions = Permissions::with('children')->whereNull('parent_id')->get();
        return $permissions;
    }
}
