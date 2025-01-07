<?php

namespace App\Interfaces;

use App\Models\Roles;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function all(): Collection;

    public function search(
        string $modelClass,             // Model to query
        array $filters = [],          // Filters for the query
        array $select = ['*'],        // Columns to select
        array $relation = [],         // Relationships to eager load
        array $joins = [],             // Tables to join
        array $orderBy = [],          // Column to order
        bool $isCollection = false,
        int $page = 10
    ):LengthAwarePaginator | Collection;

    public function create(string $modelClass, array $data = []);

    public function update(string $modelClass, string $key, mixed $value, array $data = []);

    public function delete(string $modelClass, string $key, mixed $value);

    public function deleteWhereIn(string $modelClass, string $key, array $value);

}
