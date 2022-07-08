<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\KnowledgeArea;
use App\Http\Controllers\Controller;
use App\Http\Resources\BasicCoreResource;
use App\Http\Resources\BasicCoreCollection;

class KnowledgeAreaBasicCoresController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\KnowledgeArea $knowledgeArea
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, KnowledgeArea $knowledgeArea)
    {
        //$this->authorize('view', $knowledgeArea);

        $search = $request->get('search', '');

        $basicCores = $knowledgeArea
            ->basicCores()
            ->search($search)
            ->latest()
            ->paginate();

        return new BasicCoreCollection($basicCores);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\KnowledgeArea $knowledgeArea
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, KnowledgeArea $knowledgeArea)
    {
        $this->authorize('create', BasicCore::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $basicCore = $knowledgeArea->basicCores()->create($validated);

        return new BasicCoreResource($basicCore);
    }
}
