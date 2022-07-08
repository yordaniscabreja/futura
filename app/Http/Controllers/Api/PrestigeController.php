<?php

namespace App\Http\Controllers\Api;

use App\Models\Prestige;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PrestigeResource;
use App\Http\Resources\PrestigeCollection;
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
        //$this->authorize('view-any', Prestige::class);

        $search = $request->get('search', '');

        $prestiges = Prestige::search($search)
            ->latest()
            ->paginate();

        return new PrestigeCollection($prestiges);
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

        return new PrestigeResource($prestige);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Prestige $prestige
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Prestige $prestige)
    {
        //$this->authorize('view', $prestige);

        return new PrestigeResource($prestige);
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

        return new PrestigeResource($prestige);
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

        return response()->noContent();
    }
}
