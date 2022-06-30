<?php

namespace App\Http\Controllers\Api;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CampusResource;
use App\Http\Resources\CampusCollection;

class UniversityCampusesController extends Controller
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

        $campuses = $university
            ->campuses()
            ->search($search)
            ->latest()
            ->paginate();

        return new CampusCollection($campuses);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, University $university)
    {
        $this->authorize('create', Campus::class);

        $validated = $request->validate([
            'conectividad' => ['required', 'numeric'],
            'salones' => ['required', 'numeric'],
            'laboratorios' => ['required', 'numeric'],
            'cafeterias_restaurantes' => ['required', 'numeric'],
            'espacios_comunes' => ['required', 'numeric'],
        ]);

        $campus = $university->campuses()->create($validated);

        return new CampusResource($campus);
    }
}
