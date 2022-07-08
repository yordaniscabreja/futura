<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Internalization;
use App\Http\Controllers\Controller;
use App\Http\Resources\InternalizationResource;
use App\Http\Resources\InternalizationCollection;
use App\Http\Requests\InternalizationStoreRequest;
use App\Http\Requests\InternalizationUpdateRequest;

class InternalizationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // $this->authorize('view-any', Internalization::class);

        $search = $request->get('search', '');

        $internalizations = Internalization::search($search)
            ->latest()
            ->paginate();

        return new InternalizationCollection($internalizations);
    }

    /**
     * @param \App\Http\Requests\InternalizationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(InternalizationStoreRequest $request)
    {
        $this->authorize('create', Internalization::class);

        $validated = $request->validated();

        $internalization = Internalization::create($validated);

        return new InternalizationResource($internalization);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Internalization $internalization
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Internalization $internalization)
    {
       // $this->authorize('view', $internalization);

        return new InternalizationResource($internalization);
    }

    /**
     * @param \App\Http\Requests\InternalizationUpdateRequest $request
     * @param \App\Models\Internalization $internalization
     * @return \Illuminate\Http\Response
     */
    public function update(
        InternalizationUpdateRequest $request,
        Internalization $internalization
    ) {
        $this->authorize('update', $internalization);

        $validated = $request->validated();

        $internalization->update($validated);

        return new InternalizationResource($internalization);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Internalization $internalization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Internalization $internalization)
    {
        $this->authorize('delete', $internalization);

        $internalization->delete();

        return response()->noContent();
    }
}
