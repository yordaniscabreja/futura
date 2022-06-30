<?php

namespace App\Http\Controllers;

use App\Models\BasicCore;
use Illuminate\Http\Request;
use App\Models\KnowledgeArea;
use App\Http\Requests\BasicCoreStoreRequest;
use App\Http\Requests\BasicCoreUpdateRequest;

class BasicCoreController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', BasicCore::class);

        $search = $request->get('search', '');

        $basicCores = BasicCore::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.basic_cores.index', compact('basicCores', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', BasicCore::class);

        $knowledgeAreas = KnowledgeArea::pluck('name', 'id');

        return view('app.basic_cores.create', compact('knowledgeAreas'));
    }

    /**
     * @param \App\Http\Requests\BasicCoreStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BasicCoreStoreRequest $request)
    {
        $this->authorize('create', BasicCore::class);

        $validated = $request->validated();

        $basicCore = BasicCore::create($validated);

        return redirect()
            ->route('basic-cores.edit', $basicCore)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BasicCore $basicCore
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BasicCore $basicCore)
    {
        $this->authorize('view', $basicCore);

        return view('app.basic_cores.show', compact('basicCore'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BasicCore $basicCore
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BasicCore $basicCore)
    {
        $this->authorize('update', $basicCore);

        $knowledgeAreas = KnowledgeArea::pluck('name', 'id');

        return view(
            'app.basic_cores.edit',
            compact('basicCore', 'knowledgeAreas')
        );
    }

    /**
     * @param \App\Http\Requests\BasicCoreUpdateRequest $request
     * @param \App\Models\BasicCore $basicCore
     * @return \Illuminate\Http\Response
     */
    public function update(
        BasicCoreUpdateRequest $request,
        BasicCore $basicCore
    ) {
        $this->authorize('update', $basicCore);

        $validated = $request->validated();

        $basicCore->update($validated);

        return redirect()
            ->route('basic-cores.edit', $basicCore)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BasicCore $basicCore
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BasicCore $basicCore)
    {
        $this->authorize('delete', $basicCore);

        $basicCore->delete();

        return redirect()
            ->route('basic-cores.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
