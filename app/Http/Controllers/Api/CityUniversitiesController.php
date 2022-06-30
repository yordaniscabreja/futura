<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UniversityResource;
use App\Http\Resources\UniversityCollection;

class CityUniversitiesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, City $city)
    {
        $this->authorize('view', $city);

        $search = $request->get('search', '');

        $universities = $city
            ->universities()
            ->search($search)
            ->latest()
            ->paginate();

        return new UniversityCollection($universities);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\City $city
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, City $city)
    {
        $this->authorize('create', University::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'oficial' => ['required', 'boolean'],
            'acreditada' => ['required', 'boolean'],
            'principal' => ['required', 'boolean'],
            'url' => ['required', 'url'],
            'direccion' => ['required', 'max:255', 'string'],
            'fundada_at' => ['required', 'date'],
            'egresados' => ['required', 'numeric'],
            'description' => ['required', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $university = $city->universities()->create($validated);

        return new UniversityResource($university);
    }
}
