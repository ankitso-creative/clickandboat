<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
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
        $userId = request()->segment(3); 
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required','email','unique:users,email,'.$userId],
            'dob' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'post_code' => ['required'],
        ];
    }
}
