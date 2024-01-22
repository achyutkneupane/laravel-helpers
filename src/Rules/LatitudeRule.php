<?php

namespace AchyutN\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class LatitudeRule implements ValidationRule
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

        if ($value < -90 || $value > 90) {
            $fail("The $attribute must be between -90 and 90.");
        }
    }
}
