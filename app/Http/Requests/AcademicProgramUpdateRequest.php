<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcademicProgramUpdateRequest extends FormRequest
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
            'snies_code' => ['required', 'max:255', 'string'],
            'acreditado' => ['required', 'boolean'],
            'credits' => ['required', 'numeric'],
            'numero_duracion' => ['required', 'numeric'],
            'periodo_duracion' => ['required', 'max:255', 'string'],
            'jornada' => ['required', 'max:255', 'string'],
            'precio' => ['required', 'max:255', 'string'],
            'university_id' => ['required', 'exists:universities,id'],
            'basic_core_id' => ['required', 'exists:basic_cores,id'],
            'academic_level_id' => ['required', 'exists:academic_levels,id'],
            'modality_id' => ['required', 'exists:modalities,id'],
            'education_level_id' => ['required', 'exists:education_levels,id'],
        ];
    }
}
