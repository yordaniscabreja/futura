<?php

namespace App\Http\Controllers\Api;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\DepartmentCollection;

class CountryDepartmentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Country $country)
    {
        $this->authorize('view', $country);

        $search = $request->get('search', '');

        $departments = $country
            ->departments()
            ->search($search)
            ->latest()
            ->paginate();

        return new DepartmentCollection($departments);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Country $country)
    {
        $this->authorize('create', Department::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $department = $country->departments()->create($validated);

        return new DepartmentResource($department);
    }
}
