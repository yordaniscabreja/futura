<?php

namespace App\Http\Controllers;

use App\Models\Bond;
use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use App\Http\Requests\BondStoreRequest;
use App\Http\Requests\BondUpdateRequest;

class BondController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Bond::class);

        $search = $request->get('search', '');

        $bonds = Bond::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.bonds.index', compact('bonds', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Bond::class);

        $academicPrograms = AcademicProgram::pluck('name', 'id');

        return view('app.bonds.create', compact('academicPrograms'));
    }

    /**
     * @param \App\Http\Requests\BondStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BondStoreRequest $request)
    {
        $this->authorize('create', Bond::class);

        $validated = $request->validated();

        $bond = Bond::create($validated);

        return redirect()
            ->route('bonds.edit', $bond)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bond $bond
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Bond $bond)
    {
        $this->authorize('view', $bond);

        return view('app.bonds.show', compact('bond'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bond $bond
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Bond $bond)
    {
        $this->authorize('update', $bond);

        $academicPrograms = AcademicProgram::pluck('name', 'id');

        return view('app.bonds.edit', compact('bond', 'academicPrograms'));
    }

    /**
     * @param \App\Http\Requests\BondUpdateRequest $request
     * @param \App\Models\Bond $bond
     * @return \Illuminate\Http\Response
     */
    public function update(BondUpdateRequest $request, Bond $bond)
    {
        $this->authorize('update', $bond);

        $validated = $request->validated();

        $bond->update($validated);

        return redirect()
            ->route('bonds.edit', $bond)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bond $bond
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Bond $bond)
    {
        $this->authorize('delete', $bond);

        $bond->delete();

        return redirect()
            ->route('bonds.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
