<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class RoleResource extends BaseResource
{
    public function responseArray(Request $request): array|Arrayable|\JsonSerializable
    {
        $created_at = $this->dateTimeFormat($this->created_at);
        $updated_at = $this->dateTimeFormat($this->updated_at);

        return [
            'id' => $this->id,
            'role_name' => $this->role_name,
            'description' => $this->description,
            'slug' => $this->slug,
            'status' => $this->getStatusName($this->status),
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];
    }
}
