<?php

namespace App\Http\Controllers;

use App\Models\Modality;
use Illuminate\Http\Request;
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
        $this->authorize('view-any', Modality::class);

        $search = $request->get('search', '');

        $modalities = Modality::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.modalities.index', compact('modalities', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Modality::class);

        return view('app.modalities.create');
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

        return redirect()
            ->route('modalities.edit', $modality)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Modality $modality
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Modality $modality)
    {
        $this->authorize('view', $modality);

        return view('app.modalities.show', compact('modality'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Modality $modality
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Modality $modality)
    {
        $this->authorize('update', $modality);

        return view('app.modalities.edit', compact('modality'));
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

        return redirect()
            ->route('modalities.edit', $modality)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('modalities.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
