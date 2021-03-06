<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcademyUpdateRequest extends FormRequest
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
            'plan_estudio' => ['required', 'numeric'],
            'recursos_academicos' => ['required', 'numeric'],
            'tecnologia' => ['required', 'numeric'],
            'tamano_grupos' => ['required', 'numeric'],
            'excelencia_profesores' => ['required', 'numeric'],
            'academic_program_id' => [
                'required',
                'exists:academic_programs,id',
            ],
        ];
    }
}
