<?php

namespace App\Http\Controllers\Api;

use App\Models\Modality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModalityResource;
use App\Http\Resources\ModalityCollection;
use App\Http\Requests\ModalityStoreRequest;
use App\Http\Requests\ModalityUpdateRequest;

class ModalityController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // $this->authorize('view-any', Modality::class);

        $search = $request->get('search', '');

        $modalities = Modality::search($search)
            ->latest()
            ->paginate();

        return new ModalityCollection($modalities);
    }

    /**
     * @param \App\Http\Requests\ModalityStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModalityStoreRequest $request)
    {
        $this->authorize('create', Modality::class);

        $validated = $request->validated();

        $modality = Modality::create($validated);

        return new ModalityResource($modality);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Modality $modality
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Modality $modality)
    {
        $this->authorize('view', $modality);

        return new ModalityResource($modality);
    }

    /**
     * @param \App\Http\Requests\ModalityUpdateRequest $request
     * @param \App\Models\Modality $modality
     * @return \Illuminate\Http\Response
     */
    public function update(ModalityUpdateRequest $request, Modality $modality)
    {
        $this->authorize('update', $modality);

        $validated = $request->validated();

        $modality->update($validated);

        return new ModalityResource($modality);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Modality $modality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Modality $modality)
    {
        $this->authorize('delete', $modality);

        $modality->delete();

        return response()->noContent();
    }
}
