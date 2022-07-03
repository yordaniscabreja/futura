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
            'direccion' => ['required', 'max:255', 'string'],
            'fundada_at' => ['required', 'date'],
            'egresados' => ['required', 'numeric'],
            'general_description' => ['required', 'max:255', 'string'],
            'logo' => ['image', 'max:1024', 'nullable'],
            'url' => ['required', 'url'],
            'about_video_url' => ['file', 'max:1024', 'required'],
            'background_image' => ['image', 'max:1024', 'required'],
        ];
    }
}
