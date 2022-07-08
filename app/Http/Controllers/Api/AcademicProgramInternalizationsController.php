<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use App\Http\Controllers\Controller;
use App\Http\Resources\InternalizationResource;
use App\Http\Resources\InternalizationCollection;

class AcademicProgramInternalizationsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, AcademicProgram $academicProgram)
    {
       // $this->authorize('view', $academicProgram);

        $search = $request->get('search', '');

        $internalizations = $academicProgram
            ->internalizations()
            ->search($search)
            ->latest()
            ->paginate();

        return new InternalizationCollection($internalizations);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AcademicProgram $academicProgram)
    {
        $this->authorize('create', Internalization::class);

        $validated = $request->validate([
            'intercambios_movilidad' => ['required', 'numeric'],
            'facilidad_acceso' => ['required', 'numeric'],
            'relevancia_internacional' => ['required', 'numeric'],
            'convenios_internacionales' => ['required', 'numeric'],
            'segundo_idioma' => ['required', 'numeric'],
        ]);

        $internalization = $academicProgram
            ->internalizations()
            ->create($validated);

        return new InternalizationResource($internalization);
    }
}
