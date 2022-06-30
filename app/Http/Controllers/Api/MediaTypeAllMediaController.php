<?php

namespace App\Http\Controllers\Api;

use App\Models\MediaType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MediaResource;
use App\Http\Resources\MediaCollection;

class MediaTypeAllMediaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MediaType $mediaType
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, MediaType $mediaType)
    {
        $this->authorize('view', $mediaType);

        $search = $request->get('search', '');

        $allMedia = $mediaType
            ->multimedias()
            ->search($search)
            ->latest()
            ->paginate();

        return new MediaCollection($allMedia);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MediaType $mediaType
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MediaType $mediaType)
    {
        $this->authorize('create', Media::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'university_id' => ['required', 'exists:universities,id'],
            'path' => ['required', 'max:255', 'string'],
            'url' => ['nullable', 'url'],
        ]);

        $media = $mediaType->multimedias()->create($validated);

        return new MediaResource($media);
    }
}
