<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class UserResource extends BaseResource
{
    public function responseArray(Request $request): array|Arrayable|\JsonSerializable
    {
        $created_at = $this->dateTimeFormat($this->created_at);
        $updated_at = $this->dateTimeFormat($this->updated_at);
        $last_login_at = $this->last_login_at ? $this->dateTimeFormat($this->last_login_at) : null;

        return [
            'id' => $this->id,
            'username' => $this->username,
            'full_name' => $this->full_name,
            'email_address' => $this->email_address,
            'status' => $this->getStatusName($this->status),
            'last_login_at' => $last_login_at,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
            'role_id' => $this->role_id,
            'role' => $this->whenLoaded('role', fn () => $this->role->role_name),
        ];
    }
}
