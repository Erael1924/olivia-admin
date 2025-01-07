<?php

namespace App\Http\Requests\Products;

use App\Models\{
    SubCategories,
    Categories
};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubCategoryUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $subCategoryId = $this->route('id');

        return [
            'sub_category_name' => ['required', 'string', 'max:255', Rule::unique(SubCategories::class, 'name')->ignore($subCategoryId)],
            'category' => [
                'required',
                Rule::exists(Categories::class, 'id')
            ],
            'status' => ['required', 'string']
        ];
    }
}
