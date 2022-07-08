<?php

namespace App\Http\Controllers\Api;

use App\Models\Requeriment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RequerimentResource;
use App\Http\Resources\RequerimentCollection;
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
        //$this->authorize('view-any', Requeriment::class);

        $search = $request->get('search', '');

        $requeriments = Requeriment::search($search)
            ->latest()
            ->paginate();

        return new RequerimentCollection($requeriments);
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

        return new RequerimentResource($requeriment);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Requeriment $requeriment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Requeriment $requeriment)
    {
       // $this->authorize('view', $requeriment);

        return new RequerimentResource($requeriment);
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

        return new RequerimentResource($requeriment);
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

        return response()->noContent();
    }
}
