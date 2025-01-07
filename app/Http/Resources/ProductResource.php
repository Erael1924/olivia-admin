<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class ProductResource extends BaseResource
{
    public function responseArray(Request $request): array|Arrayable|\JsonSerializable
    {
        $created_at = $this->dateTimeFormat($this->created_at);
        $updated_at = $this->dateTimeFormat($this->updated_at);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'thumbnail' => $this->thumbnail,
            'collection' => $this->whenLoaded('collection', fn () => [
                'id' => $this->collection->id,
                'name' => $this->collection->name,
            ]),
            'category' => $this->whenLoaded('category', fn () => [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ]),
            'sub_category' => $this->whenLoaded('subCategory', fn () => [
                'id' => $this->subCategory->id,
                'name' => $this->subCategory->name,
            ]),
            'stock' => $this->has_variant ? $this->variants->sum('total_stock') : $this->stock,
            'sold' => $this->has_variant ? $this->variants->sum('total_sold') : $this->sold,
            'price' => $this->price,
            'min_price' => $this->variants->sum('min_price'),
            'max_price' => $this->variants->sum('max_price'),
            'status' => $this->getStatusName($this->status),
            'has_variant' => $this->has_variant,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];
    }
}
