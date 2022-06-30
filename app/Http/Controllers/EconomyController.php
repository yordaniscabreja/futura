<?php

namespace App\Http\Controllers;

use App\Models\Economy;
use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Requests\EconomyStoreRequest;
use App\Http\Requests\EconomyUpdateRequest;

class EconomyController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Economy::class);

        $search = $request->get('search', '');

        $economies = Economy::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.economies.index', compact('economies', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Economy::class);

        $universities = University::pluck('name', 'id');

        return view('app.economies.create', compact('universities'));
    }

    /**
     * @param \App\Http\Requests\EconomyStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EconomyStoreRequest $request)
    {
        $this->authorize('create', Economy::class);

        $validated = $request->validated();

        $economy = Economy::create($validated);

        return redirect()
            ->route('economies.edit', $economy)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Economy $economy
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Economy $economy)
    {
        $this->authorize('view', $economy);

        return view('app.economies.show', compact('economy'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Economy $economy
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Economy $economy)
    {
        $this->authorize('update', $economy);

        $universities = University::pluck('name', 'id');

        return view('app.economies.edit', compact('economy', 'universities'));
    }

    /**
     * @param \App\Http\Requests\EconomyUpdateRequest $request
     * @param \App\Models\Economy $economy
     * @return \Illuminate\Http\Response
     */
    public function update(EconomyUpdateRequest $request, Economy $economy)
    {
        $this->authorize('update', $economy);

        $validated = $request->validated();

        $economy->update($validated);

        return redirect()
            ->route('economies.edit', $economy)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Economy $economy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Economy $economy)
    {
        $this->authorize('delete', $economy);

        $economy->delete();

        return redirect()
            ->route('economies.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
