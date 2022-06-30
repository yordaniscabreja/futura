<?php

namespace App\Http\Controllers\Api;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PrestigeResource;
use App\Http\Resources\PrestigeCollection;

class UniversityPrestigesController extends Controller
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

        $prestiges = $university
            ->prestiges()
            ->search($search)
            ->latest()
            ->paginate();

        return new PrestigeCollection($prestiges);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, University $university)
    {
        $this->authorize('create', Prestige::class);

        $validated = $request->validate([
            'reputacion_institucional' => ['required', 'numeric'],
            'practicas_profesionales' => ['required', 'numeric'],
            'imagen_egresado' => ['required', 'numeric'],
            'asociaciones_externas' => ['required', 'numeric'],
            'bolsa_empleo' => ['required', 'numeric'],
        ]);

        $prestige = $university->prestiges()->create($validated);

        return new PrestigeResource($prestige);
    }
}
