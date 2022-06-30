<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KnowledgeArea;
use App\Http\Requests\KnowledgeAreaStoreRequest;
use App\Http\Requests\KnowledgeAreaUpdateRequest;

class KnowledgeAreaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', KnowledgeArea::class);

        $search = $request->get('search', '');

        $knowledgeAreas = KnowledgeArea::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.knowledge_areas.index',
            compact('knowledgeAreas', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', KnowledgeArea::class);

        return view('app.knowledge_areas.create');
    }

    /**
     * @param \App\Http\Requests\KnowledgeAreaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(KnowledgeAreaStoreRequest $request)
    {
        $this->authorize('create', KnowledgeArea::class);

        $validated = $request->validated();

        $knowledgeArea = KnowledgeArea::create($validated);

        return redirect()
            ->route('knowledge-areas.edit', $knowledgeArea)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\KnowledgeArea $knowledgeArea
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, KnowledgeArea $knowledgeArea)
    {
        $this->authorize('view', $knowledgeArea);

        return view('app.knowledge_areas.show', compact('knowledgeArea'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\KnowledgeArea $knowledgeArea
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, KnowledgeArea $knowledgeArea)
    {
        $this->authorize('update', $knowledgeArea);

        return view('app.knowledge_areas.edit', compact('knowledgeArea'));
    }

    /**
     * @param \App\Http\Requests\KnowledgeAreaUpdateRequest $request
     * @param \App\Models\KnowledgeArea $knowledgeArea
     * @return \Illuminate\Http\Response
     */
    public function update(
        KnowledgeAreaUpdateRequest $request,
        KnowledgeArea $knowledgeArea
    ) {
        $this->authorize('update', $knowledgeArea);

        $validated = $request->validated();

        $knowledgeArea->update($validated);

        return redirect()
            ->route('knowledge-areas.edit', $knowledgeArea)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\KnowledgeArea $knowledgeArea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, KnowledgeArea $knowledgeArea)
    {
        $this->authorize('delete', $knowledgeArea);

        $knowledgeArea->delete();

        return redirect()
            ->route('knowledge-areas.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
