<?php

namespace App\Http\Requests;

use App\Rules\CreditCardExpiryRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'credit_card_number' => 'required|numeric|digits_between:15,16',
            'expiry_date' => ['required', 'string', 'max:6', new CreditCardExpiryRule],
            'ccv' => 'required|numeric|digits_between:3, 4',
            'address' => 'nullable|string|max:255',
        ];
    }
}
