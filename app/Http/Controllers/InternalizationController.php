<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Internalization;
use App\Models\AcademicProgram;
use App\Http\Requests\InternalizationStoreRequest;
use App\Http\Requests\InternalizationUpdateRequest;

class InternalizationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Internalization::class);

        $search = $request->get('search', '');

        $internalizations = Internalization::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.internalizations.index',
            compact('internalizations', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Internalization::class);

        $academicPrograms = AcademicProgram::pluck('name', 'id');

        return view('app.internalizations.create', compact('academicPrograms'));
    }

    /**
     * @param \App\Http\Requests\InternalizationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InternalizationStoreRequest $request)
    {
        $this->authorize('create', Internalization::class);

        $validated = $request->validated();

        $internalization = Internalization::create($validated);

        return redirect()
            ->route('internalizations.edit', $internalization)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Internalization $internalization
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Internalization $internalization)
    {
        $this->authorize('view', $internalization);

        return view('app.internalizations.show', compact('internalization'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Internalization $internalization
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Internalization $internalization)
    {
        $this->authorize('update', $internalization);

        $academicPrograms = AcademicProgram::pluck('name', 'id');

        return view(
            'app.internalizations.edit',
            compact('internalization', 'academicPrograms')
        );
    }

    /**
     * @param \App\Http\Requests\InternalizationUpdateRequest $request
     * @param \App\Models\Internalization $internalization
     * @return \Illuminate\Http\Response
     */
    public function update(
        InternalizationUpdateRequest $request,
        Internalization $internalization
    ) {
        $this->authorize('update', $internalization);

        $validated = $request->validated();

        $internalization->update($validated);

        return redirect()
            ->route('internalizations.edit', $internalization)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Internalization $internalization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Internalization $internalization)
    {
        $this->authorize('delete', $internalization);

        $internalization->delete();

        return redirect()
            ->route('internalizations.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
