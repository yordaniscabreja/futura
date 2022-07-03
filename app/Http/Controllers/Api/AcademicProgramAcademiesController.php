<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use App\Http\Controllers\Controller;
use App\Http\Resources\AcademyResource;
use App\Http\Resources\AcademyCollection;

class AcademicProgramAcademiesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, AcademicProgram $academicProgram)
    {
        $this->authorize('view', $academicProgram);

        $search = $request->get('search', '');

        $academies = $academicProgram
            ->academies()
            ->search($search)
            ->latest()
            ->paginate();

        return new AcademyCollection($academies);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AcademicProgram $academicProgram)
    {
        $this->authorize('create', Academy::class);

        $validated = $request->validate([
            'plan_estudio' => ['required', 'numeric'],
            'recursos_academicos' => ['required', 'numeric'],
            'tecnologia' => ['required', 'numeric'],
            'tamano_grupos' => ['required', 'numeric'],
            'excelencia_profesores' => ['required', 'numeric'],
        ]);

        $academy = $academicProgram->academies()->create($validated);

        return new AcademyResource($academy);
    }
}
