<?php

namespace App\Rules;

use App\Http\Requests\Helper\RequestHelper;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class CardValidate implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!RequestHelper::validateCardNumber($value)) {
            $fail('is not valid card number');
        }
    }
}
