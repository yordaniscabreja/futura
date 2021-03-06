<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EconomyStoreRequest extends FormRequest
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
            'financiacion' => ['required', 'numeric'],
            'becas_auxilio' => ['required', 'numeric'],
            'costos_calidad' => ['required', 'numeric'],
            'costos_manutencion' => ['required', 'numeric'],
            'costos_parqueadero' => ['required', 'numeric'],
            'academic_program_id' => [
                'required',
                'exists:academic_programs,id',
            ],
        ];
    }
}
