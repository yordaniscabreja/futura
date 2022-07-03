<?php

namespace App\Http\Controllers;

use App\Models\Beca;
use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use App\Http\Requests\BecaStoreRequest;
use App\Http\Requests\BecaUpdateRequest;

class BecaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Beca::class);

        $search = $request->get('search', '');

        $becas = Beca::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.becas.index', compact('becas', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Beca::class);

        $academicPrograms = AcademicProgram::pluck('name', 'id');

        return view('app.becas.create', compact('academicPrograms'));
    }

    /**
     * @param \App\Http\Requests\BecaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BecaStoreRequest $request)
    {
        $this->authorize('create', Beca::class);

        $validated = $request->validated();

        $beca = Beca::create($validated);

        return redirect()
            ->route('becas.edit', $beca)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Beca $beca
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Beca $beca)
    {
        $this->authorize('view', $beca);

        return view('app.becas.show', compact('beca'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Beca $beca
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Beca $beca)
    {
        $this->authorize('update', $beca);

        $academicPrograms = AcademicProgram::pluck('name', 'id');

        return view('app.becas.edit', compact('beca', 'academicPrograms'));
    }

    /**
     * @param \App\Http\Requests\BecaUpdateRequest $request
     * @param \App\Models\Beca $beca
     * @return \Illuminate\Http\Response
     */
    public function update(BecaUpdateRequest $request, Beca $beca)
    {
        $this->authorize('update', $beca);

        $validated = $request->validated();

        $beca->update($validated);

        return redirect()
            ->route('becas.edit', $beca)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Beca $beca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Beca $beca)
    {
        $this->authorize('delete', $beca);

        $beca->delete();

        return redirect()
            ->route('becas.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
