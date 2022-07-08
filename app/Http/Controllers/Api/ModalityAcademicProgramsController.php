<?php

namespace App\Http\Controllers\Api;

use App\Models\Modality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AcademicProgramResource;
use App\Http\Resources\AcademicProgramCollection;

class ModalityAcademicProgramsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Modality $modality
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Modality $modality)
    {
        //$this->authorize('view', $modality);

        $search = $request->get('search', '');

        $academicPrograms = $modality
            ->academicPrograms()
            ->search($search)
            ->latest()
            ->paginate();

        return new AcademicProgramCollection($academicPrograms);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Modality $modality
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Modality $modality)
    {
        $this->authorize('create', AcademicProgram::class);

        $validated = $request->validate([
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
            'education_level_id' => ['required', 'exists:education_levels,id'],
        ]);

        $academicProgram = $modality->academicPrograms()->create($validated);

        return new AcademicProgramResource($academicProgram);
    }
}
