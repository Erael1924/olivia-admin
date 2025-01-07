<?php

namespace App\Http\Requests;

use App\Models\{
    User,
    Roles
};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $userId = $this->route('id');
        return [
            'username' => ['required', 'string', 'alpha_num','between:3,100', Rule::unique(User::class)->ignore($userId)],
            'full_name' => ['required', 'string', 'between:3,100' ],
            'email_address' => ['required', 'string', 'max:255', 'email', Rule::unique(User::class)->ignore($userId)],
            'role' => [
                'required',
                Rule::exists(Roles::class, 'id')->where(function ($query) {

                    /** @var User $user */
                    $user = Auth::user();
                    if (!$user->is_super_admin) {
                        $query->where('id', '!=', Role::SUPER_ADMINISTRATOR);
                    }
                })
            ]
        ];
    }
}
