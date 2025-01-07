<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Rules\ImageRule;

class CompanyProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'company_logo_light' => [
                'required',
                new ImageRule()
            ],
            'company_logo_dark' => [
                'required',
                new ImageRule()
            ],
            'company_name' => [
                'required',
                'string',
                'max:255',
            ],
            'company_email_address' => [
                'required',
                'email',
                'max:255',
            ],
            'contact_number' => [
                'required',
                'string',
                'max:20',
                'regex:/^[\d\+\-\(\) ]+$/',
            ],
            'description' => [
                'required',
                'string',
                'max:500',
            ],
        ];
    }
}
