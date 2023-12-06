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
        $parts = explode('/', $value);

        if (count($parts) !== 2) {
            $fail("Invalid date format.");
            return;
        }

        [$month, $year] = $parts;

        if (!is_numeric($month) || !is_numeric($year)) {
            $fail("Invalid date format.");
            return;
        }

        $month = str_pad($month, 2, '0', STR_PAD_LEFT);

        if ($month <= 0 || $month > 12) {
            $fail("Month must be between 01 and 12.");
            return;
        }

        $expiryDate = DateTime::createFromFormat('d/m/y', '01/' . $month . '/' . $year);


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
