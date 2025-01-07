<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class MaintenanceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'maintenance_mode_message' => [
                'required_with:maintenance_start_date,maintenance_start_time,affected_platform',
                'max:255',
            ],
            'maintenance_start_date' => [
                'required_with:maintenance_mode_message,maintenance_start_time,affected_platform',
                'sometimes:date',
            ],
            'maintenance_start_time' => [
                'required_with:maintenance_mode_message,maintenance_start_date,affected_platform',
                'sometimes:date_format:H:i',
            ],
            'affected_platform' => [
                'required_with:maintenance_mode_message,maintenance_start_date,maintenance_start_time',
                'max:255',
            ],
        ];

    }
}
