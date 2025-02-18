<?php

namespace App\Http\Requests\BoatOwner\Listing;

use Illuminate\Foundation\Http\FormRequest;

class UpdateListing extends FormRequest
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
        $request = $this->all();
        if($request['s']=='general'):
            return [
                'harbour' => ['required'],
                'city' => ['required'],
                'manufacturer' => ['required'],
                'model' => ['required'],
                'capacity' => ['required'],
                'company_name' => ['required'],
                'boat_name' => ['required'],
                'length' => ['required'],
            ];
        elseif($request['s']=='price'):
            return [
                'price' => ['required'],
            ];
        elseif($request['s']=='booking'):
            return [
                'cancellation_conditions' => ['required'],
                'check_in' => ['required'],
                'check_out' => ['required'],
            ];
        elseif($request['s']=='other'):
            return [
                'engine_type' => ['required'],
                'horsepower' => ['required'],
            ];
        else:
            return [];
        endif;
    }
}
