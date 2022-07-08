<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use App\Http\Controllers\Controller;
use App\Http\Resources\CampusResource;
use App\Http\Resources\CampusCollection;

class AcademicProgramCampusesController extends Controller
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

        $campuses = $academicProgram
            ->campuses()
            ->search($search)
            ->latest()
            ->paginate();

        return new CampusCollection($campuses);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AcademicProgram $academicProgram)
    {
        $this->authorize('create', Campus::class);

        $validated = $request->validate([
            'conectividad' => ['required', 'numeric'],
            'salones' => ['required', 'numeric'],
            'laboratorios' => ['required', 'numeric'],
            'cafeterias_restaurantes' => ['required', 'numeric'],
            'espacios_comunes' => ['required', 'numeric'],
        ]);

        $campus = $academicProgram->campuses()->create($validated);

        return new CampusResource($campus);
    }
}
