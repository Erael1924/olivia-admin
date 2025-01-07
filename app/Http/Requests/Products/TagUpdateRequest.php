<?php

namespace App\Http\Requests\Products;

use App\Models\{
    Tags
};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $tagId = $this->route('id');

        return [
            'tag_name' => ['required', 'string', 'max:255', Rule::unique(Tags::class, 'name')->ignore($tagId)]
        ];
    }
}
