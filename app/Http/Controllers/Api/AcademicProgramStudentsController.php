<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Http\Resources\StudentCollection;

class AcademicProgramStudentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, AcademicProgram $academicProgram)
    {
        //$this->authorize('view', $academicProgram);

        $search = $request->get('search', '');

        $students = $academicProgram
            ->students()
            ->search($search)
            ->latest()
            ->paginate();

        return new StudentCollection($students);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AcademicProgram $academicProgram)
    {
        $this->authorize('create', Student::class);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'semestre' => ['required', 'numeric'],
        ]);

        $student = $academicProgram->students()->create($validated);

        return new StudentResource($student);
    }
}
