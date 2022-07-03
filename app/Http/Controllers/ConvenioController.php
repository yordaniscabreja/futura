<?php

namespace App\Http\Controllers;

use App\Models\Convenio;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.convenios.index', compact('convenios', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Convenio::class);

        $universities = University::pluck('name', 'id');

        return view('app.convenios.create', compact('universities'));
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

        return redirect()
            ->route('convenios.edit', $convenio)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Convenio $convenio
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Convenio $convenio)
    {
        $this->authorize('view', $convenio);

        return view('app.convenios.show', compact('convenio'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Convenio $convenio
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Convenio $convenio)
    {
        $this->authorize('update', $convenio);

        $universities = University::pluck('name', 'id');

        return view('app.convenios.edit', compact('convenio', 'universities'));
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

        return redirect()
            ->route('convenios.edit', $convenio)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('convenios.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
