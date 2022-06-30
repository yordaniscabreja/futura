<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentCollection;

class StudentCommentsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Student $student)
    {
        $this->authorize('view', $student);

        $search = $request->get('search', '');

        $comments = $student
            ->comments()
            ->search($search)
            ->latest()
            ->paginate();

        return new CommentCollection($comments);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Student $student)
    {
        $this->authorize('create', Comment::class);

        $validated = $request->validate([
            'comment' => ['required', 'max:255', 'string'],
        ]);

        $comment = $student->comments()->create($validated);

        return new CommentResource($comment);
    }
}
