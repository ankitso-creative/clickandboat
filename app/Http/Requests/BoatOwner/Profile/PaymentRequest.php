<?php

namespace App\Http\Requests\BoatOwner\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class PaymentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'account_type' => ['required'],
            'confirmiban' => ['same:iban'],
            'confirmbaccount_number' => ['same:account_number'],
        ];
    }
    public function messages(): array
    {
        return [
            'confirmiban.same' => 'The confirmation IBAN must match the original IBAN.',
            'confirmbaccount_number.same' => 'The confirmation account number must match the original account number.',
        ];
    }
}
