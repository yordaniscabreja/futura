<?php

namespace App\Http\Controllers\Api;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Resources\BecaResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\BecaCollection;

class UniversityBecasController extends Controller
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

        $becas = $university
            ->becas()
            ->search($search)
            ->latest()
            ->paginate();

        return new BecaCollection($becas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, University $university)
    {
        $this->authorize('create', Beca::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $beca = $university->becas()->create($validated);

        return new BecaResource($beca);
    }
}
