<?php

namespace App\Interfaces;

use App\Models\Roles;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    ProductVariants,
    Variants
};

interface ProductRepositoryInterface
{
    public function search(array $filters = [], string $stockFilter = "", array $orderBy = [], int $page = 10):LengthAwarePaginator | Collection;
    public function removeVariant($id);
    public function removeVariantOption($option, $optionLevel);
}
