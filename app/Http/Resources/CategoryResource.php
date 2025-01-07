<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class CategoryResource extends BaseResource
{
    public function responseArray(Request $request): array|Arrayable|\JsonSerializable
    {
        $created_at = $this->dateTimeFormat($this->created_at);
        $updated_at = $this->dateTimeFormat($this->updated_at);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'collections' => $this->whenLoaded('collectionType', fn () => $this->collectionType->map(function ($collection) {
                return [
                    'id' => $collection->id,
                    'name' => $collection->name,
                ];
            })),
            'status' => $this->getStatusName($this->status),
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];
    }
}
