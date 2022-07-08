<?php

namespace App\Http\Controllers\Api;

use App\Models\BasicCore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AcademicProgramResource;
use App\Http\Resources\AcademicProgramCollection;

class BasicCoreAcademicProgramsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BasicCore $basicCore
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, BasicCore $basicCore)
    {
        //$this->authorize('view', $basicCore);

        $search = $request->get('search', '');

        $academicPrograms = $basicCore
            ->academicPrograms()
            ->search($search)
            ->latest()
            ->paginate();

        return new AcademicProgramCollection($academicPrograms);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BasicCore $basicCore
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, BasicCore $basicCore)
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
            'academic_level_id' => ['required', 'exists:academic_levels,id'],
            'modality_id' => ['required', 'exists:modalities,id'],
            'education_level_id' => ['required', 'exists:education_levels,id'],
        ]);

        $academicProgram = $basicCore->academicPrograms()->create($validated);

        return new AcademicProgramResource($academicProgram);
    }
}
