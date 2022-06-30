<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;

class CommentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Comment::class);

        $search = $request->get('search', '');

        $comments = Comment::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.comments.index', compact('comments', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Comment::class);

        $students = Student::pluck('id', 'id');

        return view('app.comments.create', compact('students'));
    }

    /**
     * @param \App\Http\Requests\CommentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentStoreRequest $request)
    {
        $this->authorize('create', Comment::class);

        $validated = $request->validated();

        $comment = Comment::create($validated);

        return redirect()
            ->route('comments.edit', $comment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Comment $comment)
    {
        $this->authorize('view', $comment);

        return view('app.comments.show', compact('comment'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $students = Student::pluck('id', 'id');

        return view('app.comments.edit', compact('comment', 'students'));
    }

    /**
     * @param \App\Http\Requests\CommentUpdateRequest $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validated = $request->validated();

        $comment->update($validated);

        return redirect()
            ->route('comments.edit', $comment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()
            ->route('comments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
