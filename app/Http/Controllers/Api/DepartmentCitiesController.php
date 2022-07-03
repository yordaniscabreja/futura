<?php

namespace App\Http\Controllers\Api;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Resources\CityResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\CityCollection;

class DepartmentCitiesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Department $department)
    {
        $this->authorize('view', $department);

        $search = $request->get('search', '');

        $cities = $department
            ->cities()
            ->search($search)
            ->latest()
            ->paginate();

        return new CityCollection($cities);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Department $department)
    {
        $this->authorize('create', City::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $city = $department->cities()->create($validated);

        return new CityResource($city);
    }
}
