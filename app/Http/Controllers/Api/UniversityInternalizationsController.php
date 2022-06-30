<?php

namespace App\Http\Controllers\Api;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\InternalizationResource;
use App\Http\Resources\InternalizationCollection;

class UniversityInternalizationsController extends Controller
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

        $internalizations = $university
            ->internalizations()
            ->search($search)
            ->latest()
            ->paginate();

        return new InternalizationCollection($internalizations);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, University $university)
    {
        $this->authorize('create', Internalization::class);

        $validated = $request->validate([
            'intercambios_movilidad' => ['required', 'numeric'],
            'facilidad_acceso' => ['required', 'numeric'],
            'relevancia_internacional' => ['required', 'numeric'],
            'convenios_internacionales' => ['required', 'numeric'],
            'segundo_idioma' => ['required', 'numeric'],
        ]);

        $internalization = $university->internalizations()->create($validated);

        return new InternalizationResource($internalization);
    }
}
