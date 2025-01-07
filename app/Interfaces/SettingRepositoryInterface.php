<?php

namespace App\Interfaces;

use App\Models\Roles;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface SettingRepositoryInterface
{
    public function update($request);

}
