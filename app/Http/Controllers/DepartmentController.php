<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentStoreRequest;
use App\Http\Requests\DepartmentUpdateRequest;

class DepartmentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Department::class);

        $search = $request->get('search', '');

        $departments = Department::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.departments.index', compact('departments', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Department::class);

        $countries = Country::pluck('name', 'id');

        return view('app.departments.create', compact('countries'));
    }

    /**
     * @param \App\Http\Requests\DepartmentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentStoreRequest $request)
    {
        $this->authorize('create', Department::class);

        $validated = $request->validated();

        $department = Department::create($validated);

        return redirect()
            ->route('departments.edit', $department)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Department $department)
    {
        $this->authorize('view', $department);

        return view('app.departments.show', compact('department'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Department $department)
    {
        $this->authorize('update', $department);

        $countries = Country::pluck('name', 'id');

        return view('app.departments.edit', compact('department', 'countries'));
    }

    /**
     * @param \App\Http\Requests\DepartmentUpdateRequest $request
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function update(
        DepartmentUpdateRequest $request,
        Department $department
    ) {
        $this->authorize('update', $department);

        $validated = $request->validated();

        $department->update($validated);

        return redirect()
            ->route('departments.edit', $department)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Department $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Department $department)
    {
        $this->authorize('delete', $department);

        $department->delete();

        return redirect()
            ->route('departments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
