<?php

namespace App\Interfaces;

use App\Models\Roles;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface RoleRepositoryInterface
{
    public function all(): Collection;

    public function search(array $filters, int $page = 10):LengthAwarePaginator;

}
