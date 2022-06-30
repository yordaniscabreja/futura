<?php

namespace App\Http\Controllers\Api;

use App\Models\Rectoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\RectoriaResource;
use App\Http\Resources\RectoriaCollection;
use App\Http\Requests\RectoriaStoreRequest;
use App\Http\Requests\RectoriaUpdateRequest;

class RectoriaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Rectoria::class);

        $search = $request->get('search', '');

        $rectorias = Rectoria::search($search)
            ->latest()
            ->paginate();

        return new RectoriaCollection($rectorias);
    }

    /**
     * @param \App\Http\Requests\RectoriaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RectoriaStoreRequest $request)
    {
        $this->authorize('create', Rectoria::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $rectoria = Rectoria::create($validated);

        return new RectoriaResource($rectoria);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Rectoria $rectoria
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Rectoria $rectoria)
    {
        $this->authorize('view', $rectoria);

        return new RectoriaResource($rectoria);
    }

    /**
     * @param \App\Http\Requests\RectoriaUpdateRequest $request
     * @param \App\Models\Rectoria $rectoria
     * @return \Illuminate\Http\Response
     */
    public function update(RectoriaUpdateRequest $request, Rectoria $rectoria)
    {
        $this->authorize('update', $rectoria);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($rectoria->image) {
                Storage::delete($rectoria->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $rectoria->update($validated);

        return new RectoriaResource($rectoria);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Rectoria $rectoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Rectoria $rectoria)
    {
        $this->authorize('delete', $rectoria);

        if ($rectoria->image) {
            Storage::delete($rectoria->image);
        }

        $rectoria->delete();

        return response()->noContent();
    }
}
