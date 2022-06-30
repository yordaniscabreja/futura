<?php

namespace App\Http\Controllers\Api;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LifeStyleResource;
use App\Http\Resources\LifeStyleCollection;

class UniversityLifeStylesController extends Controller
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

        $lifeStyles = $university
            ->lifeStyles()
            ->search($search)
            ->latest()
            ->paginate();

        return new LifeStyleCollection($lifeStyles);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, University $university)
    {
        $this->authorize('create', LifeStyle::class);

        $validated = $request->validate([
            'ambiente' => ['required', 'numeric'],
            'diversion_ocio' => ['required', 'numeric'],
            'descanso_relax' => ['required', 'numeric'],
            'cultura_ecologica' => ['required', 'numeric'],
            'servicio_estudiante' => ['required', 'numeric'],
        ]);

        $lifeStyle = $university->lifeStyles()->create($validated);

        return new LifeStyleResource($lifeStyle);
    }
}
