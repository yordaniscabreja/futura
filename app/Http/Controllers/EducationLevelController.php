<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationLevel;
use App\Http\Requests\EducationLevelStoreRequest;
use App\Http\Requests\EducationLevelUpdateRequest;

class EducationLevelController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', EducationLevel::class);

        $search = $request->get('search', '');

        $educationLevels = EducationLevel::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.education_levels.index',
            compact('educationLevels', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', EducationLevel::class);

        return view('app.education_levels.create');
    }

    /**
     * @param \App\Http\Requests\EducationLevelStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EducationLevelStoreRequest $request)
    {
        $this->authorize('create', EducationLevel::class);

        $validated = $request->validated();

        $educationLevel = EducationLevel::create($validated);

        return redirect()
            ->route('education-levels.edit', $educationLevel)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EducationLevel $educationLevel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, EducationLevel $educationLevel)
    {
        $this->authorize('view', $educationLevel);

        return view('app.education_levels.show', compact('educationLevel'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EducationLevel $educationLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, EducationLevel $educationLevel)
    {
        $this->authorize('update', $educationLevel);

        return view('app.education_levels.edit', compact('educationLevel'));
    }

    /**
     * @param \App\Http\Requests\EducationLevelUpdateRequest $request
     * @param \App\Models\EducationLevel $educationLevel
     * @return \Illuminate\Http\Response
     */
    public function update(
        EducationLevelUpdateRequest $request,
        EducationLevel $educationLevel
    ) {
        $this->authorize('update', $educationLevel);

        $validated = $request->validated();

        $educationLevel->update($validated);

        return redirect()
            ->route('education-levels.edit', $educationLevel)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\EducationLevel $educationLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, EducationLevel $educationLevel)
    {
        $this->authorize('delete', $educationLevel);

        $educationLevel->delete();

        return redirect()
            ->route('education-levels.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
