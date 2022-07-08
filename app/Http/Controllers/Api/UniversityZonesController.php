<?php

namespace App\Http\Controllers\Api;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Resources\ZoneResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\ZoneCollection;

class UniversityZonesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, University $university)
    {
        //$this->authorize('view', $university);

        $search = $request->get('search', '');

        $zones = $university
            ->zones()
            ->search($search)
            ->latest()
            ->paginate();

        return new ZoneCollection($zones);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, University $university)
    {
        $this->authorize('create', Zone::class);

        $validated = $request->validate([
            'facilidad_transporte' => ['required', 'numeric'],
            'seguridad_zona' => ['required', 'numeric'],
            'opciones_parqueo' => ['required', 'numeric'],
            'opciones_vivir' => ['required', 'numeric'],
            'opciones_comer' => ['required', 'numeric'],
        ]);

        $zone = $university->zones()->create($validated);

        return new ZoneResource($zone);
    }
}
