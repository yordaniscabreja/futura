<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampusStoreRequest extends FormRequest
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
            'conectividad' => ['required', 'numeric'],
            'salones' => ['required', 'numeric'],
            'laboratorios' => ['required', 'numeric'],
            'cafeterias_restaurantes' => ['required', 'numeric'],
            'espacios_comunes' => ['required', 'numeric'],
            'university_id' => ['required', 'exists:universities,id'],
        ];
    }
}
