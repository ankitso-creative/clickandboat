<?php

namespace App\Http\Requests\BoatOwner\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class CompanyRequest extends FormRequest
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
            'company_name' => ['required'],
            'companyaddress' => ['required'],
            'intracommunity_vat' => ['required'],
            'website' => ['required'],
            'certificate' => ['required'],
            'identity' => ['required'],
            'iban' => ['required'],
            'ownership' => ['required'],
        ];
    }
}
