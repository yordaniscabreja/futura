<?php

namespace App\Http\Controllers\Api;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MediaResource;
use App\Http\Resources\MediaCollection;

class UniversityAllMediaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, University $university)
    {
        $this->authorize('view', $university);

        $search = $request->get('search', '');

        $allMedia = $university
            ->allMedia()
            ->search($search)
            ->latest()
            ->paginate();

        return new MediaCollection($allMedia);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, University $university)
    {
        $this->authorize('create', Media::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'path' => ['required', 'max:255', 'string'],
            'url' => ['nullable', 'url'],
            'media_type_id' => ['required', 'exists:media_types,id'],
        ]);

        $media = $university->allMedia()->create($validated);

        return new MediaResource($media);
    }
}
