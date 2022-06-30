<?php

namespace App\Http\Controllers;

use App\Models\Beca;
use App\Models\Benefit;
use Illuminate\Http\Request;
use App\Http\Requests\BenefitStoreRequest;
use App\Http\Requests\BenefitUpdateRequest;

class BenefitController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Benefit::class);

        $search = $request->get('search', '');

        $benefits = Benefit::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.benefits.index', compact('benefits', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Benefit::class);

        $becas = Beca::pluck('name', 'id');

        return view('app.benefits.create', compact('becas'));
    }

    /**
     * @param \App\Http\Requests\BenefitStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BenefitStoreRequest $request)
    {
        $this->authorize('create', Benefit::class);

        $validated = $request->validated();

        $benefit = Benefit::create($validated);

        return redirect()
            ->route('benefits.edit', $benefit)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Benefit $benefit
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Benefit $benefit)
    {
        $this->authorize('view', $benefit);

        return view('app.benefits.show', compact('benefit'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Benefit $benefit
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Benefit $benefit)
    {
        $this->authorize('update', $benefit);

        $becas = Beca::pluck('name', 'id');

        return view('app.benefits.edit', compact('benefit', 'becas'));
    }

    /**
     * @param \App\Http\Requests\BenefitUpdateRequest $request
     * @param \App\Models\Benefit $benefit
     * @return \Illuminate\Http\Response
     */
    public function update(BenefitUpdateRequest $request, Benefit $benefit)
    {
        $this->authorize('update', $benefit);

        $validated = $request->validated();

        $benefit->update($validated);

        return redirect()
            ->route('benefits.edit', $benefit)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Benefit $benefit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Benefit $benefit)
    {
        $this->authorize('delete', $benefit);

        $benefit->delete();

        return redirect()
            ->route('benefits.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
