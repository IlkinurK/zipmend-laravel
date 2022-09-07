<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInterViewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'addresses' => 'required|array|min:2',
            'addresses.*.country' => 'required|exists:cities,country',
            'addresses.*.zip' => 'required|exists:cities,zipCode',
            'addresses.*.city' => 'required|exists:cities,name',
        ];
    }


}
