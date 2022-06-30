<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\MediaType;
use App\Models\University;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.all_media.index', compact('allMedia', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Media::class);

        $universities = University::pluck('name', 'id');
        $mediaTypes = MediaType::pluck('type', 'id');

        return view(
            'app.all_media.create',
            compact('universities', 'mediaTypes')
        );
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

        return redirect()
            ->route('all-media.edit', $media)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Media $media
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Media $media)
    {
        $this->authorize('view', $media);

        return view('app.all_media.show', compact('media'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Media $media
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Media $media)
    {
        $this->authorize('update', $media);

        $universities = University::pluck('name', 'id');
        $mediaTypes = MediaType::pluck('type', 'id');

        return view(
            'app.all_media.edit',
            compact('media', 'universities', 'mediaTypes')
        );
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

        return redirect()
            ->route('all-media.edit', $media)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('all-media.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
