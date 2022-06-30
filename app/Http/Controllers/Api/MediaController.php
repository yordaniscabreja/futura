<?php

namespace App\Http\Controllers\Api;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MediaResource;
use App\Http\Resources\MediaCollection;
use App\Http\Requests\MediaStoreRequest;
use App\Http\Requests\MediaUpdateRequest;

class MediaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Media::class);

        $search = $request->get('search', '');

        $allMedia = Media::search($search)
            ->latest()
            ->paginate();

        return new MediaCollection($allMedia);
    }

    /**
     * @param \App\Http\Requests\MediaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MediaStoreRequest $request)
    {
        $this->authorize('create', Media::class);

        $validated = $request->validated();

        $media = Media::create($validated);

        return new MediaResource($media);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Media $media
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Media $media)
    {
        $this->authorize('view', $media);

        return new MediaResource($media);
    }

    /**
     * @param \App\Http\Requests\MediaUpdateRequest $request
     * @param \App\Models\Media $media
     * @return \Illuminate\Http\Response
     */
    public function update(MediaUpdateRequest $request, Media $media)
    {
        $this->authorize('update', $media);

        $validated = $request->validated();

        $media->update($validated);

        return new MediaResource($media);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Media $media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Media $media)
    {
        $this->authorize('delete', $media);

        $media->delete();

        return response()->noContent();
    }
}
