<?php

namespace App\Http\Controllers;

use App\Models\Prestige;
use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Requests\PrestigeStoreRequest;
use App\Http\Requests\PrestigeUpdateRequest;

class PrestigeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Prestige::class);

        $search = $request->get('search', '');

        $prestiges = Prestige::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.prestiges.index', compact('prestiges', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Prestige::class);

        $universities = University::pluck('name', 'id');

        return view('app.prestiges.create', compact('universities'));
    }

    /**
     * @param \App\Http\Requests\PrestigeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrestigeStoreRequest $request)
    {
        $this->authorize('create', Prestige::class);

        $validated = $request->validated();

        $prestige = Prestige::create($validated);

        return redirect()
            ->route('prestiges.edit', $prestige)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Prestige $prestige
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Prestige $prestige)
    {
        $this->authorize('view', $prestige);

        return view('app.prestiges.show', compact('prestige'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Prestige $prestige
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Prestige $prestige)
    {
        $this->authorize('update', $prestige);

        $universities = University::pluck('name', 'id');

        return view('app.prestiges.edit', compact('prestige', 'universities'));
    }

    /**
     * @param \App\Http\Requests\PrestigeUpdateRequest $request
     * @param \App\Models\Prestige $prestige
     * @return \Illuminate\Http\Response
     */
    public function update(PrestigeUpdateRequest $request, Prestige $prestige)
    {
        $this->authorize('update', $prestige);

        $validated = $request->validated();

        $prestige->update($validated);

        return redirect()
            ->route('prestiges.edit', $prestige)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Prestige $prestige
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Prestige $prestige)
    {
        $this->authorize('delete', $prestige);

        $prestige->delete();

        return redirect()
            ->route('prestiges.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
