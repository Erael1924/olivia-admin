<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class TagResource extends BaseResource
{
    public function responseArray(Request $request): array|Arrayable|\JsonSerializable
    {
        $created_at = $this->dateTimeFormat($this->created_at);
        $updated_at = $this->dateTimeFormat($this->updated_at);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];
    }
}
