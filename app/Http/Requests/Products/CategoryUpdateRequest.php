<?php

namespace App\Http\Requests\Products;

use App\Models\{
    Categories,
    Collections
};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $categoryId = $this->route('id');

        return [
            'category_name' => ['required', 'string', 'max:255', Rule::unique(Categories::class, 'name')->ignore($categoryId)],
            'collection' => [
                'required',
                'array',
            ],
            'collection.*' => [
                'numeric',
                Rule::exists(Collections::class, 'id')
            ],
            'status' => ['required', 'string']
        ];
    }
}
