<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UniversityStoreRequest extends FormRequest
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
            'oficial' => ['required', 'boolean'],
            'acreditada' => ['required', 'boolean'],
            'city_id' => ['required', 'exists:cities,id'],
            'principal' => ['required', 'boolean'],
            'url' => ['required', 'url'],
            'direccion' => ['required', 'max:255', 'string'],
            'fundada_at' => ['required', 'date'],
            'egresados' => ['required', 'numeric'],
            'description' => ['required', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
        ];
    }
}
