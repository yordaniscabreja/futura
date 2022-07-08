<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use App\Http\Controllers\Controller;
use App\Http\Resources\WellnessResource;
use App\Http\Resources\WellnessCollection;

class AcademicProgramWellnessesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, AcademicProgram $academicProgram)
    {
        //$this->authorize('view', $academicProgram);

        $search = $request->get('search', '');

        $wellnesses = $academicProgram
            ->wellnesses()
            ->search($search)
            ->latest()
            ->paginate();

        return new WellnessCollection($wellnesses);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AcademicProgram $academicProgram)
    {
        $this->authorize('create', Wellness::class);

        $validated = $request->validate([
            'orientacion_psicologia' => ['required', 'numeric'],
            'actividades_deportivas' => ['required', 'numeric'],
            'actividades_culturales' => ['required', 'numeric'],
            'plan_covid19' => ['required', 'numeric'],
            'felicidad_entorno' => ['required', 'numeric'],
        ]);

        $wellness = $academicProgram->wellnesses()->create($validated);

        return new WellnessResource($wellness);
    }
}
