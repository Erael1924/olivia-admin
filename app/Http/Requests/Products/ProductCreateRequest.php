<?php

namespace App\Http\Requests\Products;

use App\Models\{
    Products,
    Categories,
    Collections,
    SubCategories,
    Tags
};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ImageRule;

class ProductCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $firstPage = [
            'thumbnail' => [
                'required',
                // new ImageRule()
            ],
            'product_name' => [
                'required',
                'string',
                'max:255'
            ],
            'description' => [
                'required',
            ],
            'collection' => [
                'required',
                Rule::exists(Collections::class, 'id')
            ],
            'category' => [
                'required',
                Rule::exists(Categories::class, 'id')
            ],
            'sub_category' => [
                'required',
                Rule::exists(SubCategories::class, 'id')
            ],
            'tags' => [
                'nullable',
                Rule::exists(Tags::class, 'id')
            ],
            'product_details' => [
                'nullable',
                'array'
            ],
            'product_details.*.attribute' => [
                'required_with:product_details.*.value',
            ],
            'product_details.*.value' => [
                'required_with:product_details.*.attribute',
            ],
        ];

        $secondPage = [
            'has_variant' => [
                'required',
                'in:1,0'
            ],
            'price' => [
                'required_if:has_variant,0',
                'nullable',
                // 'decimal:0,2'
            ],
            'stock' => [
                'required_if:has_variant,0',
                'nullable',
                // 'decimal:0,2'
            ],
            'product_images' => [
                'required_if:has_variant,0',
            ],
            'variants' => [
                'required_if:has_variant,1',
                'array'
            ],
            'variants.*.name' => [
                'required',
            ],
            'variants.*.options' => [
                'required',
            ],
            'variants.0.options.*.name' => [
                'required_if:has_variant,1'
            ],
            'variants.0.options.*.images' => [
                'required_if:has_variant,1'
            ],
            'weight' => [
                'required',
                'decimal:0,2',
            ],
            'width' => [
                'nullable',
                'decimal:0,2',
            ],
            'length' => [
                'nullable',
                'decimal:0,2',
            ],
            'height' => [
                'nullable',
                'decimal:0,2'
            ],
        ];

        if($this->form == 1){
            return [];
        }else if($this->form == 2){
            return $secondPage;
        }else{
            return [...$firstPage, ...$secondPage];
        }
    }

}
