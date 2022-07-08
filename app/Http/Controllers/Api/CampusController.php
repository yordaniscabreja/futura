<?php

namespace App\Http\Controllers\Api;

use App\Models\Campus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CampusResource;
use App\Http\Resources\CampusCollection;
use App\Http\Requests\CampusStoreRequest;
use App\Http\Requests\CampusUpdateRequest;

class CampusController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // $this->authorize('view-any', Campus::class);

        $search = $request->get('search', '');

        $campuses = Campus::search($search)
            ->latest()
            ->paginate();

        return new CampusCollection($campuses);
    }

    /**
     * @param \App\Http\Requests\CampusStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampusStoreRequest $request)
    {
        $this->authorize('create', Campus::class);

        $validated = $request->validated();

        $campus = Campus::create($validated);

        return new CampusResource($campus);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Campus $campus
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Campus $campus)
    {
       // $this->authorize('view', $campus);

        return new CampusResource($campus);
    }

    /**
     * @param \App\Http\Requests\CampusUpdateRequest $request
     * @param \App\Models\Campus $campus
     * @return \Illuminate\Http\Response
     */
    public function update(CampusUpdateRequest $request, Campus $campus)
    {
        $this->authorize('update', $campus);

        $validated = $request->validated();

        $campus->update($validated);

        return new CampusResource($campus);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Campus $campus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Campus $campus)
    {
        $this->authorize('delete', $campus);

        $campus->delete();

        return response()->noContent();
    }
}
