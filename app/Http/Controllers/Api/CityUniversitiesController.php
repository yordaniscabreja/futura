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
       // $this->authorize('view', $city);

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
            'direccion' => ['required', 'max:255', 'string'],
            'fundada_at' => ['required', 'date'],
            'egresados' => ['required', 'numeric'],
            'general_description' => ['required', 'max:255', 'string'],
            'logo' => ['image', 'max:1024', 'nullable'],
            'url' => ['required', 'url'],
            'about_video_url' => ['file', 'max:1024', 'required'],
            'background_image' => ['image', 'max:1024', 'required'],
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('public');
        }

        if ($request->hasFile('about_video_url')) {
            $validated['about_video_url'] = $request
                ->file('about_video_url')
                ->store('public');
        }

        if ($request->hasFile('background_image')) {
            $validated['background_image'] = $request
                ->file('background_image')
                ->store('public');
        }

        $university = $city->universities()->create($validated);

        return new UniversityResource($university);
    }
}
