<?php

namespace App\Http\Requests;

use App\Models\Roles;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $roleId = $this->route('id');

        return [
            'role_name' => ['required', 'string', 'max:255',Rule::unique(Roles::class)->ignore($roleId) ],
            'description' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string']
        ];
    }
}
