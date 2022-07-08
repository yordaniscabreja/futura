<?php

namespace App\Http\Controllers\Api;

use App\Models\BasicCore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BasicCoreResource;
use App\Http\Resources\BasicCoreCollection;
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
        //$this->authorize('view-any', BasicCore::class);

        $search = $request->get('search', '');

        $basicCores = BasicCore::search($search)
            ->latest()
            ->paginate();

        return new BasicCoreCollection($basicCores);
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

        return new BasicCoreResource($basicCore);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BasicCore $basicCore
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BasicCore $basicCore)
    {
       // $this->authorize('view', $basicCore);

        return new BasicCoreResource($basicCore);
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

        return new BasicCoreResource($basicCore);
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

        return response()->noContent();
    }
}
