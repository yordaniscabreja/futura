<?php

namespace App\Http\Controllers;

use App\Models\Beca;
use App\Models\Requeriment;
use Illuminate\Http\Request;
use App\Http\Requests\RequerimentStoreRequest;
use App\Http\Requests\RequerimentUpdateRequest;

class RequerimentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Requeriment::class);

        $search = $request->get('search', '');

        $requeriments = Requeriment::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.requeriments.index',
            compact('requeriments', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Requeriment::class);

        $becas = Beca::pluck('name', 'id');

        return view('app.requeriments.create', compact('becas'));
    }

    /**
     * @param \App\Http\Requests\RequerimentStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequerimentStoreRequest $request)
    {
        $this->authorize('create', Requeriment::class);

        $validated = $request->validated();

        $requeriment = Requeriment::create($validated);

        return redirect()
            ->route('requeriments.edit', $requeriment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Requeriment $requeriment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Requeriment $requeriment)
    {
        $this->authorize('view', $requeriment);

        return view('app.requeriments.show', compact('requeriment'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Requeriment $requeriment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Requeriment $requeriment)
    {
        $this->authorize('update', $requeriment);

        $becas = Beca::pluck('name', 'id');

        return view('app.requeriments.edit', compact('requeriment', 'becas'));
    }

    /**
     * @param \App\Http\Requests\RequerimentUpdateRequest $request
     * @param \App\Models\Requeriment $requeriment
     * @return \Illuminate\Http\Response
     */
    public function update(
        RequerimentUpdateRequest $request,
        Requeriment $requeriment
    ) {
        $this->authorize('update', $requeriment);

        $validated = $request->validated();

        $requeriment->update($validated);

        return redirect()
            ->route('requeriments.edit', $requeriment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Requeriment $requeriment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Requeriment $requeriment)
    {
        $this->authorize('delete', $requeriment);

        $requeriment->delete();

        return redirect()
            ->route('requeriments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
