<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use App\Http\Controllers\Controller;
use App\Http\Resources\PrestigeResource;
use App\Http\Resources\PrestigeCollection;

class AcademicProgramPrestigesController extends Controller
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

        $prestiges = $academicProgram
            ->prestiges()
            ->search($search)
            ->latest()
            ->paginate();

        return new PrestigeCollection($prestiges);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AcademicProgram $academicProgram)
    {
        $this->authorize('create', Prestige::class);

        $validated = $request->validate([
            'reputacion_institucional' => ['required', 'numeric'],
            'practicas_profesionales' => ['required', 'numeric'],
            'imagen_egresado' => ['required', 'numeric'],
            'asociaciones_externas' => ['required', 'numeric'],
            'bolsa_empleo' => ['required', 'numeric'],
        ]);

        $prestige = $academicProgram->prestiges()->create($validated);

        return new PrestigeResource($prestige);
    }
}
