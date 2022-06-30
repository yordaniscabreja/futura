<?php

namespace App\Http\Controllers\Api;

use App\Models\Economy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EconomyResource;
use App\Http\Resources\EconomyCollection;
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
            ->paginate();

        return new EconomyCollection($economies);
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

        return new EconomyResource($economy);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Economy $economy
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Economy $economy)
    {
        $this->authorize('view', $economy);

        return new EconomyResource($economy);
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

        return new EconomyResource($economy);
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

        return response()->noContent();
    }
}
