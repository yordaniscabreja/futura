<?php

namespace App\Http\Controllers\Api;

use App\Models\Convenio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ConvenioResource;
use App\Http\Resources\ConvenioCollection;
use App\Http\Requests\ConvenioStoreRequest;
use App\Http\Requests\ConvenioUpdateRequest;

class ConvenioController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Convenio::class);

        $search = $request->get('search', '');

        $convenios = Convenio::search($search)
            ->latest()
            ->paginate();

        return new ConvenioCollection($convenios);
    }

    /**
     * @param \App\Http\Requests\ConvenioStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ConvenioStoreRequest $request)
    {
        $this->authorize('create', Convenio::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $convenio = Convenio::create($validated);

        return new ConvenioResource($convenio);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Convenio $convenio
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Convenio $convenio)
    {
        $this->authorize('view', $convenio);

        return new ConvenioResource($convenio);
    }

    /**
     * @param \App\Http\Requests\ConvenioUpdateRequest $request
     * @param \App\Models\Convenio $convenio
     * @return \Illuminate\Http\Response
     */
    public function update(ConvenioUpdateRequest $request, Convenio $convenio)
    {
        $this->authorize('update', $convenio);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($convenio->image) {
                Storage::delete($convenio->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $convenio->update($validated);

        return new ConvenioResource($convenio);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Convenio $convenio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Convenio $convenio)
    {
        $this->authorize('delete', $convenio);

        if ($convenio->image) {
            Storage::delete($convenio->image);
        }

        $convenio->delete();

        return response()->noContent();
    }
}
