<?php

namespace App\Http\Controllers\Api;

use App\Models\Wellness;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\WellnessResource;
use App\Http\Resources\WellnessCollection;
use App\Http\Requests\WellnessStoreRequest;
use App\Http\Requests\WellnessUpdateRequest;

class WellnessController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Wellness::class);

        $search = $request->get('search', '');

        $wellnesses = Wellness::search($search)
            ->latest()
            ->paginate();

        return new WellnessCollection($wellnesses);
    }

    /**
     * @param \App\Http\Requests\WellnessStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(WellnessStoreRequest $request)
    {
        $this->authorize('create', Wellness::class);

        $validated = $request->validated();

        $wellness = Wellness::create($validated);

        return new WellnessResource($wellness);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wellness $wellness
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Wellness $wellness)
    {
        $this->authorize('view', $wellness);

        return new WellnessResource($wellness);
    }

    /**
     * @param \App\Http\Requests\WellnessUpdateRequest $request
     * @param \App\Models\Wellness $wellness
     * @return \Illuminate\Http\Response
     */
    public function update(WellnessUpdateRequest $request, Wellness $wellness)
    {
        $this->authorize('update', $wellness);

        $validated = $request->validated();

        $wellness->update($validated);

        return new WellnessResource($wellness);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wellness $wellness
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Wellness $wellness)
    {
        $this->authorize('delete', $wellness);

        $wellness->delete();

        return response()->noContent();
    }
}
