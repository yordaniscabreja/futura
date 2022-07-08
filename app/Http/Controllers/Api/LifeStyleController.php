<?php

namespace App\Http\Controllers\Api;

use App\Models\LifeStyle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LifeStyleResource;
use App\Http\Resources\LifeStyleCollection;
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
      //  $this->authorize('view-any', LifeStyle::class);

        $search = $request->get('search', '');

        $lifeStyles = LifeStyle::search($search)
            ->latest()
            ->paginate();

        return new LifeStyleCollection($lifeStyles);
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

        return new LifeStyleResource($lifeStyle);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\LifeStyle $lifeStyle
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, LifeStyle $lifeStyle)
    {
        //$this->authorize('view', $lifeStyle);

        return new LifeStyleResource($lifeStyle);
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

        return new LifeStyleResource($lifeStyle);
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

        return response()->noContent();
    }
}
