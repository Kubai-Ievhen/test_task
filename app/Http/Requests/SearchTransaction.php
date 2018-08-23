<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchTransaction extends FormRequest
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
            'customer_id' => 'nullable|numeric|exists:customers,id',
            'amount' => 'nullable|numeric',
            'date' => 'nullable|date_format:Y-m-d',
            'offset' => 'nullable|numeric',
            'limit' => 'required_with:offset|nullable|numeric',
        ];
    }
}
