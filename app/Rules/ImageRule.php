<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\ValidationRule;

class ImageRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {

        if ($value != null) {
            if(strpos($value['image'], 'data:image') === 0){
                if(!stristr($value['image'], "data:image/png") && !stristr($value['image'], "data:image/jpeg")){
                    $fail(trans('validation.mimes', ['values' => '(jpeg, png)']));
                }
            }

            $imageData = base64_decode($value['size']);
            $maxSizeInBytes = 1024 * 1024 * 2;
            if (strlen($imageData) > $maxSizeInBytes) {
                $fail(trans('validation.size.file', ['size' => '2048']));
            }
        }
    }
}
