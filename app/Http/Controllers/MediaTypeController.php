<?php

namespace App\Http\Controllers;

use App\Models\MediaType;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.media_types.index', compact('mediaTypes', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', MediaType::class);

        return view('app.media_types.create');
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

        return redirect()
            ->route('media-types.edit', $mediaType)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MediaType $mediaType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, MediaType $mediaType)
    {
        $this->authorize('view', $mediaType);

        return view('app.media_types.show', compact('mediaType'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MediaType $mediaType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, MediaType $mediaType)
    {
        $this->authorize('update', $mediaType);

        return view('app.media_types.edit', compact('mediaType'));
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

        return redirect()
            ->route('media-types.edit', $mediaType)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('media-types.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
