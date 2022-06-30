<?php

namespace App\Http\Controllers\Api;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EconomyResource;
use App\Http\Resources\EconomyCollection;

class UniversityEconomiesController extends Controller
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

        $economies = $university
            ->economies()
            ->search($search)
            ->latest()
            ->paginate();

        return new EconomyCollection($economies);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, University $university)
    {
        $this->authorize('create', Economy::class);

        $validated = $request->validate([
            'financiacion' => ['required', 'numeric'],
            'becas_auxilio' => ['required', 'numeric'],
            'costos_calidad' => ['required', 'numeric'],
            'costos_manutencion' => ['required', 'numeric'],
            'costos_parqueadero' => ['required', 'numeric'],
        ]);

        $economy = $university->economies()->create($validated);

        return new EconomyResource($economy);
    }
}
