<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgreementStoreRequest extends FormRequest
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
            'duracion' => ['required', 'numeric'],
            'representante' => ['required', 'max:255', 'string'],
            'university_id' => ['required', 'exists:universities,id'],
            'tasa_interes' => ['required', 'numeric'],
            'tasa_descuento' => ['required', 'numeric'],
        ];
    }
}
