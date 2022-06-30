<?php

namespace App\Http\Controllers\Api;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WellnessResource;
use App\Http\Resources\WellnessCollection;

class UniversityWellnessesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, University $university)
    {
        $this->authorize('view', $university);

        $search = $request->get('search', '');

        $wellnesses = $university
            ->wellnesses()
            ->search($search)
            ->latest()
            ->paginate();

        return new WellnessCollection($wellnesses);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, University $university)
    {
        $this->authorize('create', Wellness::class);

        $validated = $request->validate([
            'orientacion_psicologia' => ['required', 'numeric'],
            'actividades_deportivas' => ['required', 'numeric'],
            'actividades_culturales' => ['required', 'numeric'],
            'plan_covid19' => ['required', 'numeric'],
            'felicidad_entorno' => ['required', 'numeric'],
        ]);

        $wellness = $university->wellnesses()->create($validated);

        return new WellnessResource($wellness);
    }
}
