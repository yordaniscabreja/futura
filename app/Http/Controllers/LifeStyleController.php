<?php

namespace App\Http\Controllers;

use App\Models\LifeStyle;
use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Requests\LifeStyleStoreRequest;
use App\Http\Requests\LifeStyleUpdateRequest;

class LifeStyleController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', LifeStyle::class);

        $search = $request->get('search', '');

        $lifeStyles = LifeStyle::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.life_styles.index', compact('lifeStyles', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', LifeStyle::class);

        $universities = University::pluck('name', 'id');

        return view('app.life_styles.create', compact('universities'));
    }

    /**
     * @param \App\Http\Requests\LifeStyleStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LifeStyleStoreRequest $request)
    {
        $this->authorize('create', LifeStyle::class);

        $validated = $request->validated();

        $lifeStyle = LifeStyle::create($validated);

        return redirect()
            ->route('life-styles.edit', $lifeStyle)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\LifeStyle $lifeStyle
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, LifeStyle $lifeStyle)
    {
        $this->authorize('view', $lifeStyle);

        return view('app.life_styles.show', compact('lifeStyle'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\LifeStyle $lifeStyle
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, LifeStyle $lifeStyle)
    {
        $this->authorize('update', $lifeStyle);

        $universities = University::pluck('name', 'id');

        return view(
            'app.life_styles.edit',
            compact('lifeStyle', 'universities')
        );
    }

    /**
     * @param \App\Http\Requests\LifeStyleUpdateRequest $request
     * @param \App\Models\LifeStyle $lifeStyle
     * @return \Illuminate\Http\Response
     */
    public function update(
        LifeStyleUpdateRequest $request,
        LifeStyle $lifeStyle
    ) {
        $this->authorize('update', $lifeStyle);

        $validated = $request->validated();

        $lifeStyle->update($validated);

        return redirect()
            ->route('life-styles.edit', $lifeStyle)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\LifeStyle $lifeStyle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, LifeStyle $lifeStyle)
    {
        $this->authorize('delete', $lifeStyle);

        $lifeStyle->delete();

        return redirect()
            ->route('life-styles.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
