<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Requests\AcademyStoreRequest;
use App\Http\Requests\AcademyUpdateRequest;

class AcademyController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Academy::class);

        $search = $request->get('search', '');

        $academies = Academy::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.academies.index', compact('academies', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Academy::class);

        $universities = University::pluck('name', 'id');

        return view('app.academies.create', compact('universities'));
    }

    /**
     * @param \App\Http\Requests\AcademyStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcademyStoreRequest $request)
    {
        $this->authorize('create', Academy::class);

        $validated = $request->validated();

        $academy = Academy::create($validated);

        return redirect()
            ->route('academies.edit', $academy)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Academy $academy
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Academy $academy)
    {
        $this->authorize('view', $academy);

        return view('app.academies.show', compact('academy'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Academy $academy
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Academy $academy)
    {
        $this->authorize('update', $academy);

        $universities = University::pluck('name', 'id');

        return view('app.academies.edit', compact('academy', 'universities'));
    }

    /**
     * @param \App\Http\Requests\AcademyUpdateRequest $request
     * @param \App\Models\Academy $academy
     * @return \Illuminate\Http\Response
     */
    public function update(AcademyUpdateRequest $request, Academy $academy)
    {
        $this->authorize('update', $academy);

        $validated = $request->validated();

        $academy->update($validated);

        return redirect()
            ->route('academies.edit', $academy)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Academy $academy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Academy $academy)
    {
        $this->authorize('delete', $academy);

        $academy->delete();

        return redirect()
            ->route('academies.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
