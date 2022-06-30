<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BondUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'agreement_id' => ['required', 'exists:agreements,id'],
        ];
    }
}
