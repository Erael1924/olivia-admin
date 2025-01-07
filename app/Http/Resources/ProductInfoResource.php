<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class ProductInfoResource extends ProductResource
{
    public function responseArray(Request $request): array|Arrayable|\JsonSerializable
    {
        $response = parent::responseArray($request);

        $info = [
            'description' => $this->description,
            'tags' => $this->tags,
            'weight' => $this->weight,
            'width' => $this->width,
            'height' => $this->height,
            'length' => $this->length,
            'variants' => $this->variants,
            'images' => $this->whenLoaded('images', fn () => $this->images->map(function ($image) {
                return [
                    'id' => $image->id,
                    'image' => $image->image_url,
                ];
            })),
            'details' => $this->whenLoaded('details', fn () => $this->details->map(function ($detail) {
                return [
                    'attribute' => $detail->attribute,
                    'value' => $detail->value,
                ];
            })),
        ];

        return [...$response, ...$info];
    }
}
