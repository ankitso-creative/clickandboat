<?php

namespace App\Http\Requests\Admin\Listing;

use Illuminate\Foundation\Http\FormRequest;

class StoreListingRequest extends FormRequest
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
        $request = request()->all();
        if($request['s']=='general'):
            return [
                'user_id' => ['required'],
                'harbour' => ['required'],
                'city' => ['required'],
                'manufacturer' => ['required'],
                'model' => ['required'],
                'capacity' => ['required'],
                'company_name' => ['required'],
                'boat_name' => ['required'],
            ];
        elseif($request['s']=='price'):
            return [
                'season_price.1.from' => ['required'],
                'season_price.2.from' => ['required'],
                'season_price.3.from' => ['required'],
                'season_price.1.price' => ['required'],
                'season_price.2.price' => ['required'],
                'season_price.3.price' => ['required'],
                
                
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
    public function messages()
    {
        return [
            'season_price.1.from.required' => 'The low season month field required.',
            'season_price.2.from.required' => 'The mid season month field required.',
            'season_price.3.from.required' => 'The high season month field required.',
            'season_price.1.price.required' => 'The low season full day price field required.',
            'season_price.2.price.required' => 'The mid season full day price field required.',
            'season_price.3.price.required' => 'The high season full day price field required.',
        ];
    }
}
