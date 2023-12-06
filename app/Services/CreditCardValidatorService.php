<?php

namespace App\Services;

use DateTime;
use Illuminate\Validation\ValidationException;

class CreditCardValidatorService
{
    public function validateCreditCard(string $creditCardNumber, string $expiryDate): void
    {
        $this->isValidCreditCardNumber($creditCardNumber);
        $this->validatorForExpiryDate($expiryDate);
    }

    private function isValidCreditCardNumber($number)
    {
        $number = str_replace(' ', '', $number);
        $length = strlen($number);
        $sum = 0;
        $alternate = false;

        for ($i = $length - 1; $i >= 0; $i--) {
            $digit = intval($number[$i]);

            if ($alternate) {
                $digit *= 2;

                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $sum += $digit;
            $alternate = !$alternate;
        }

        if ($sum % 10 !== 0) {
            throw ValidationException::withMessages(['credit_card_number' => 'Invalid credit card number!']);
        }
    }

    private function validatorForExpiryDate(string $expiryDate)
    {
        $lastDayOfCurrentMonth = (new DateTime('last day of this month'))->format('y-m-d');
        $creditCardExpiryDate = DateTime::createFromFormat('m/Y', $expiryDate)->modify('last day of this month')->format('y-m-d');
        if ($lastDayOfCurrentMonth > $creditCardExpiryDate) {
            throw ValidationException::withMessages(['expiry_date' => 'Card is expired!Add new credit card to proceed!']);
        }
    }
}
