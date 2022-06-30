<?php

namespace App\Http\Controllers\Api;

use App\Models\MediaType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MediaTypeResource;
use App\Http\Resources\MediaTypeCollection;
use App\Http\Requests\MediaTypeStoreRequest;
use App\Http\Requests\MediaTypeUpdateRequest;

class MediaTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', MediaType::class);

        $search = $request->get('search', '');

        $mediaTypes = MediaType::search($search)
            ->latest()
            ->paginate();

        return new MediaTypeCollection($mediaTypes);
    }

    /**
     * @param \App\Http\Requests\MediaTypeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MediaTypeStoreRequest $request)
    {
        $this->authorize('create', MediaType::class);

        $validated = $request->validated();

        $mediaType = MediaType::create($validated);

        return new MediaTypeResource($mediaType);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MediaType $mediaType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, MediaType $mediaType)
    {
        $this->authorize('view', $mediaType);

        return new MediaTypeResource($mediaType);
    }

    /**
     * @param \App\Http\Requests\MediaTypeUpdateRequest $request
     * @param \App\Models\MediaType $mediaType
     * @return \Illuminate\Http\Response
     */
    public function update(
        MediaTypeUpdateRequest $request,
        MediaType $mediaType
    ) {
        $this->authorize('update', $mediaType);

        $validated = $request->validated();

        $mediaType->update($validated);

        return new MediaTypeResource($mediaType);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MediaType $mediaType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, MediaType $mediaType)
    {
        $this->authorize('delete', $mediaType);

        $mediaType->delete();

        return response()->noContent();
    }
}
