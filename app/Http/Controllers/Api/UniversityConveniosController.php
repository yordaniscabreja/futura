<?php

namespace App\Http\Controllers\Api;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ConvenioResource;
use App\Http\Resources\ConvenioCollection;

class UniversityConveniosController extends Controller
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

        $convenios = $university
            ->convenios()
            ->search($search)
            ->latest()
            ->paginate();

        return new ConvenioCollection($convenios);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, University $university)
    {
        $this->authorize('create', Convenio::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
            'about' => ['required', 'max:255', 'string'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $convenio = $university->convenios()->create($validated);

        return new ConvenioResource($convenio);
    }
}
