<?php

namespace App\Http\Controllers;

use App\Models\Rectoria;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.rectorias.index', compact('rectorias', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Rectoria::class);

        $universities = University::pluck('name', 'id');

        return view('app.rectorias.create', compact('universities'));
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

        return redirect()
            ->route('rectorias.edit', $rectoria)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Rectoria $rectoria
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Rectoria $rectoria)
    {
        $this->authorize('view', $rectoria);

        return view('app.rectorias.show', compact('rectoria'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Rectoria $rectoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Rectoria $rectoria)
    {
        $this->authorize('update', $rectoria);

        $universities = University::pluck('name', 'id');

        return view('app.rectorias.edit', compact('rectoria', 'universities'));
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

        return redirect()
            ->route('rectorias.edit', $rectoria)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('rectorias.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
