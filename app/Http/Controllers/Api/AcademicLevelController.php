<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AcademicLevel;
use App\Http\Controllers\Controller;
use App\Http\Resources\AcademicLevelResource;
use App\Http\Resources\AcademicLevelCollection;
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
            ->paginate();

        return new AcademicLevelCollection($academicLevels);
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

        return new AcademicLevelResource($academicLevel);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicLevel $academicLevel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, AcademicLevel $academicLevel)
    {
        $this->authorize('view', $academicLevel);

        return new AcademicLevelResource($academicLevel);
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

        return new AcademicLevelResource($academicLevel);
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

        return response()->noContent();
    }
}
