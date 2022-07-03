<?php

namespace App\Http\Controllers;

use App\Models\Wellness;
use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use App\Http\Requests\WellnessStoreRequest;
use App\Http\Requests\WellnessUpdateRequest;

class WellnessController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Wellness::class);

        $search = $request->get('search', '');

        $wellnesses = Wellness::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.wellnesses.index', compact('wellnesses', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Wellness::class);

        $academicPrograms = AcademicProgram::pluck('name', 'id');

        return view('app.wellnesses.create', compact('academicPrograms'));
    }

    /**
     * @param \App\Http\Requests\WellnessStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WellnessStoreRequest $request)
    {
        $this->authorize('create', Wellness::class);

        $validated = $request->validated();

        $wellness = Wellness::create($validated);

        return redirect()
            ->route('wellnesses.edit', $wellness)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wellness $wellness
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Wellness $wellness)
    {
        $this->authorize('view', $wellness);

        return view('app.wellnesses.show', compact('wellness'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wellness $wellness
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Wellness $wellness)
    {
        $this->authorize('update', $wellness);

        $academicPrograms = AcademicProgram::pluck('name', 'id');

        return view(
            'app.wellnesses.edit',
            compact('wellness', 'academicPrograms')
        );
    }

    /**
     * @param \App\Http\Requests\WellnessUpdateRequest $request
     * @param \App\Models\Wellness $wellness
     * @return \Illuminate\Http\Response
     */
    public function update(WellnessUpdateRequest $request, Wellness $wellness)
    {
        $this->authorize('update', $wellness);

        $validated = $request->validated();

        $wellness->update($validated);

        return redirect()
            ->route('wellnesses.edit', $wellness)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wellness $wellness
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Wellness $wellness)
    {
        $this->authorize('delete', $wellness);

        $wellness->delete();

        return redirect()
            ->route('wellnesses.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
