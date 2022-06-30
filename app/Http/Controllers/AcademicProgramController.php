<?php

namespace App\Http\Controllers;

use App\Models\Modality;
use App\Models\BasicCore;
use App\Models\University;
use Illuminate\Http\Request;
use App\Models\AcademicLevel;
use App\Models\EducationLevel;
use App\Models\AcademicProgram;
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
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.academic_programs.index',
            compact('academicPrograms', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', AcademicProgram::class);

        $universities = University::pluck('name', 'id');
        $basicCores = BasicCore::pluck('name', 'id');
        $academicLevels = AcademicLevel::pluck('name', 'id');
        $modalities = Modality::pluck('name', 'id');
        $educationLevels = EducationLevel::pluck('name', 'id');

        return view(
            'app.academic_programs.create',
            compact(
                'universities',
                'basicCores',
                'academicLevels',
                'modalities',
                'educationLevels'
            )
        );
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

        return redirect()
            ->route('academic-programs.edit', $academicProgram)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, AcademicProgram $academicProgram)
    {
        $this->authorize('view', $academicProgram);

        return view('app.academic_programs.show', compact('academicProgram'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, AcademicProgram $academicProgram)
    {
        $this->authorize('update', $academicProgram);

        $universities = University::pluck('name', 'id');
        $basicCores = BasicCore::pluck('name', 'id');
        $academicLevels = AcademicLevel::pluck('name', 'id');
        $modalities = Modality::pluck('name', 'id');
        $educationLevels = EducationLevel::pluck('name', 'id');

        return view(
            'app.academic_programs.edit',
            compact(
                'academicProgram',
                'universities',
                'basicCores',
                'academicLevels',
                'modalities',
                'educationLevels'
            )
        );
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

        return redirect()
            ->route('academic-programs.edit', $academicProgram)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('academic-programs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
