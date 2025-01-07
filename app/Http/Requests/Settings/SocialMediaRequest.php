<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class SocialMediaRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'facebook' => [
                'nullable',
                'string',
                'url'
            ],
            'instagram' => [
                'nullable',
                'string',
                'url'
            ],
            'x' => [
                'nullable',
                'string',
                'url'
            ],
            'tiktok' => [
                'nullable',
                'string',
                'url'
            ],
        ];
    }
}
