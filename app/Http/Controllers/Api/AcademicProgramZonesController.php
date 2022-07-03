<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use App\Http\Resources\ZoneResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\ZoneCollection;

class AcademicProgramZonesController extends Controller
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

        $zones = $academicProgram
            ->zones()
            ->search($search)
            ->latest()
            ->paginate();

        return new ZoneCollection($zones);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AcademicProgram $academicProgram)
    {
        $this->authorize('create', Zone::class);

        $validated = $request->validate([
            'facilidad_transporte' => ['required', 'numeric'],
            'seguridad_zona' => ['required', 'numeric'],
            'opciones_parqueo' => ['required', 'numeric'],
            'opciones_vivir' => ['required', 'numeric'],
            'opciones_comer' => ['required', 'numeric'],
        ]);

        $zone = $academicProgram->zones()->create($validated);

        return new ZoneResource($zone);
    }
}
