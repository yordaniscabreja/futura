<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InternalizationStoreRequest extends FormRequest
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
            'intercambios_movilidad' => ['required', 'numeric'],
            'facilidad_acceso' => ['required', 'numeric'],
            'relevancia_internacional' => ['required', 'numeric'],
            'convenios_internacionales' => ['required', 'numeric'],
            'segundo_idioma' => ['required', 'numeric'],
            'academic_program_id' => [
                'required',
                'exists:academic_programs,id',
            ],
        ];
    }
}
