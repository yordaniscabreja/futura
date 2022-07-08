<?php

namespace App\Http\Controllers\Api;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RectoriaResource;
use App\Http\Resources\RectoriaCollection;

class UniversityRectoriasController extends Controller
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

        $rectorias = $university
            ->rectorias()
            ->search($search)
            ->latest()
            ->paginate();

        return new RectoriaCollection($rectorias);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, University $university)
    {
        $this->authorize('create', Rectoria::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'last_name' => ['required', 'max:255', 'string'],
            'position' => ['required', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $rectoria = $university->rectorias()->create($validated);

        return new RectoriaResource($rectoria);
    }
}
