<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicLevel;
use App\Http\Requests\AcademicLevelStoreRequest;
use App\Http\Requests\AcademicLevelUpdateRequest;

class AcademicLevelController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', AcademicLevel::class);

        $search = $request->get('search', '');

        $academicLevels = AcademicLevel::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.academic_levels.index',
            compact('academicLevels', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', AcademicLevel::class);

        return view('app.academic_levels.create');
    }

    /**
     * @param \App\Http\Requests\AcademicLevelStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcademicLevelStoreRequest $request)
    {
        $this->authorize('create', AcademicLevel::class);

        $validated = $request->validated();

        $academicLevel = AcademicLevel::create($validated);

        return redirect()
            ->route('academic-levels.edit', $academicLevel)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicLevel $academicLevel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, AcademicLevel $academicLevel)
    {
        $this->authorize('view', $academicLevel);

        return view('app.academic_levels.show', compact('academicLevel'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicLevel $academicLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, AcademicLevel $academicLevel)
    {
        $this->authorize('update', $academicLevel);

        return view('app.academic_levels.edit', compact('academicLevel'));
    }

    /**
     * @param \App\Http\Requests\AcademicLevelUpdateRequest $request
     * @param \App\Models\AcademicLevel $academicLevel
     * @return \Illuminate\Http\Response
     */
    public function update(
        AcademicLevelUpdateRequest $request,
        AcademicLevel $academicLevel
    ) {
        $this->authorize('update', $academicLevel);

        $validated = $request->validated();

        $academicLevel->update($validated);

        return redirect()
            ->route('academic-levels.edit', $academicLevel)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicLevel $academicLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, AcademicLevel $academicLevel)
    {
        $this->authorize('delete', $academicLevel);

        $academicLevel->delete();

        return redirect()
            ->route('academic-levels.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
