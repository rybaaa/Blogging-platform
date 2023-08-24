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
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'credit_card_number' => 'required|numeric|digits_between:15,16',
            'expiry_date' => ['required', 'string', 'max:5', 'date_format:m/y', new CreditCardExpiryRule],
            'cvv' => 'required|numeric|digits_between:3, 4',
            'address' => 'nullable|string|max:255',
        ];
    }
}
