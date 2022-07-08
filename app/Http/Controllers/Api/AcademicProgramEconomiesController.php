<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use App\Http\Controllers\Controller;
use App\Http\Resources\EconomyResource;
use App\Http\Resources\EconomyCollection;

class AcademicProgramEconomiesController extends Controller
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

        $economies = $academicProgram
            ->economies()
            ->search($search)
            ->latest()
            ->paginate();

        return new EconomyCollection($economies);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AcademicProgram $academicProgram)
    {
        $this->authorize('create', Economy::class);

        $validated = $request->validate([
            'financiacion' => ['required', 'numeric'],
            'becas_auxilio' => ['required', 'numeric'],
            'costos_calidad' => ['required', 'numeric'],
            'costos_manutencion' => ['required', 'numeric'],
            'costos_parqueadero' => ['required', 'numeric'],
        ]);

        $economy = $academicProgram->economies()->create($validated);

        return new EconomyResource($economy);
    }
}
