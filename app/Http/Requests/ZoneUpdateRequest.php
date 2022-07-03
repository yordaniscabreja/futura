<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZoneUpdateRequest extends FormRequest
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
            'facilidad_transporte' => ['required', 'numeric'],
            'seguridad_zona' => ['required', 'numeric'],
            'opciones_parqueo' => ['required', 'numeric'],
            'opciones_vivir' => ['required', 'numeric'],
            'opciones_comer' => ['required', 'numeric'],
            'academic_program_id' => [
                'required',
                'exists:academic_programs,id',
            ],
        ];
    }
}
