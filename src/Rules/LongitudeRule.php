<?php

namespace AchyutN\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class LongitudeRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_numeric($value)) {
            $fail("The $attribute must be a number.");
        }

        if ($value < -180 || $value > 180) {
            $fail("The $attribute must be between -180 and 180.");
        }
    }
}
