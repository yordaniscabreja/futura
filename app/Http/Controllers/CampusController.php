<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use App\Http\Requests\CampusStoreRequest;
use App\Http\Requests\CampusUpdateRequest;

class CampusController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Campus::class);

        $search = $request->get('search', '');

        $campuses = Campus::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.campuses.index', compact('campuses', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Campus::class);

        $academicPrograms = AcademicProgram::pluck('name', 'id');

        return view('app.campuses.create', compact('academicPrograms'));
    }

    /**
     * @param \App\Http\Requests\CampusStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampusStoreRequest $request)
    {
        $this->authorize('create', Campus::class);

        $validated = $request->validated();

        $campus = Campus::create($validated);

        return redirect()
            ->route('campuses.edit', $campus)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Campus $campus
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Campus $campus)
    {
        $this->authorize('view', $campus);

        return view('app.campuses.show', compact('campus'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Campus $campus
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Campus $campus)
    {
        $this->authorize('update', $campus);

        $academicPrograms = AcademicProgram::pluck('name', 'id');

        return view('app.campuses.edit', compact('campus', 'academicPrograms'));
    }

    /**
     * @param \App\Http\Requests\CampusUpdateRequest $request
     * @param \App\Models\Campus $campus
     * @return \Illuminate\Http\Response
     */
    public function update(CampusUpdateRequest $request, Campus $campus)
    {
        $this->authorize('update', $campus);

        $validated = $request->validated();

        $campus->update($validated);

        return redirect()
            ->route('campuses.edit', $campus)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Campus $campus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Campus $campus)
    {
        $this->authorize('delete', $campus);

        $campus->delete();

        return redirect()
            ->route('campuses.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
