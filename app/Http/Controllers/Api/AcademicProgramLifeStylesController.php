<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use App\Http\Controllers\Controller;
use App\Http\Resources\LifeStyleResource;
use App\Http\Resources\LifeStyleCollection;

class AcademicProgramLifeStylesController extends Controller
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

        $lifeStyles = $academicProgram
            ->lifeStyles()
            ->search($search)
            ->latest()
            ->paginate();

        return new LifeStyleCollection($lifeStyles);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AcademicProgram $academicProgram)
    {
        $this->authorize('create', LifeStyle::class);

        $validated = $request->validate([
            'ambiente' => ['required', 'numeric'],
            'diversion_ocio' => ['required', 'numeric'],
            'descanso_relax' => ['required', 'numeric'],
            'cultura_ecologica' => ['required', 'numeric'],
            'servicio_estudiante' => ['required', 'numeric'],
        ]);

        $lifeStyle = $academicProgram->lifeStyles()->create($validated);

        return new LifeStyleResource($lifeStyle);
    }
}
