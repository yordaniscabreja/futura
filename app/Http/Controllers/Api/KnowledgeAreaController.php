<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\KnowledgeArea;
use App\Http\Controllers\Controller;
use App\Http\Resources\KnowledgeAreaResource;
use App\Http\Resources\KnowledgeAreaCollection;
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
       // $this->authorize('view-any', KnowledgeArea::class);

        $search = $request->get('search', '');

        $knowledgeAreas = KnowledgeArea::search($search)
            ->latest()
            ->paginate();

        return new KnowledgeAreaCollection($knowledgeAreas);
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

        return new KnowledgeAreaResource($knowledgeArea);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\KnowledgeArea $knowledgeArea
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, KnowledgeArea $knowledgeArea)
    {
       // $this->authorize('view', $knowledgeArea);

        return new KnowledgeAreaResource($knowledgeArea);
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

        return new KnowledgeAreaResource($knowledgeArea);
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

        return response()->noContent();
    }
}
