<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use App\Http\Controllers\Controller;
use App\Http\Resources\AcademicProgramResource;
use App\Http\Resources\AcademicProgramCollection;
use App\Http\Requests\AcademicProgramStoreRequest;
use App\Http\Requests\AcademicProgramUpdateRequest;

class AcademicProgramController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', AcademicProgram::class);

        $search = $request->get('search', '');

        $academicPrograms = AcademicProgram::search($search)
            ->latest()
            ->paginate();

        return new AcademicProgramCollection($academicPrograms);
    }

    /**
     * @param \App\Http\Requests\AcademicProgramStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcademicProgramStoreRequest $request)
    {
        $this->authorize('create', AcademicProgram::class);

        $validated = $request->validated();

        $academicProgram = AcademicProgram::create($validated);

        return new AcademicProgramResource($academicProgram);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, AcademicProgram $academicProgram)
    {
        $this->authorize('view', $academicProgram);

        return new AcademicProgramResource($academicProgram);
    }

    /**
     * @param \App\Http\Requests\AcademicProgramUpdateRequest $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function update(
        AcademicProgramUpdateRequest $request,
        AcademicProgram $academicProgram
    ) {
        $this->authorize('update', $academicProgram);

        $validated = $request->validated();

        $academicProgram->update($validated);

        return new AcademicProgramResource($academicProgram);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, AcademicProgram $academicProgram)
    {
        $this->authorize('delete', $academicProgram);

        $academicProgram->delete();

        return response()->noContent();
    }
}
