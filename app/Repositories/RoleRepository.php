<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Roles;

class RoleRepository implements RoleRepositoryInterface
{
    public function all(): Collection
    {
        return AuditLogs::all();
    }

    public function search(array $filters, int $page = 10):LengthAwarePaginator
    {
        $data = Roles::query();

        return $data->paginate($page);
    }
}
