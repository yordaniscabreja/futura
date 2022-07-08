<?php

namespace App\Http\Controllers\Api;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Http\Resources\StudentCollection;

class UniversityStudentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, University $university)
    {
        //$this->authorize('view', $university);

        $search = $request->get('search', '');

        $students = $university
            ->students()
            ->search($search)
            ->latest()
            ->paginate();

        return new StudentCollection($students);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, University $university)
    {
        $this->authorize('create', Student::class);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'semestre' => ['required', 'numeric'],
        ]);

        $student = $university->students()->create($validated);

        return new StudentResource($student);
    }
}
