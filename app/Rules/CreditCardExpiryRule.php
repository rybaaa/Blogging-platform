<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use DateTime;

class CreditCardExpiryRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $expiryDate = DateTime::createFromFormat('d/m/y', '01/' . $value);

        if (!$expiryDate) {
            $fail("Invalid date format.");
            return;
        }

        $expiryDate->modify('last day of');


        if ($expiryDate < new DateTime()) {
            $fail("The credit card has expired.");
        }
    }
}
