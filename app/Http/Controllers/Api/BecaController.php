<?php

namespace App\Http\Controllers\Api;

use App\Models\Beca;
use Illuminate\Http\Request;
use App\Http\Resources\BecaResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\BecaCollection;
use App\Http\Requests\BecaStoreRequest;
use App\Http\Requests\BecaUpdateRequest;

class BecaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Beca::class);

        $search = $request->get('search', '');

        $becas = Beca::search($search)
            ->latest()
            ->paginate();

        return new BecaCollection($becas);
    }

    /**
     * @param \App\Http\Requests\BecaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BecaStoreRequest $request)
    {
        $this->authorize('create', Beca::class);

        $validated = $request->validated();

        $beca = Beca::create($validated);

        return new BecaResource($beca);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Beca $beca
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Beca $beca)
    {
        $this->authorize('view', $beca);

        return new BecaResource($beca);
    }

    /**
     * @param \App\Http\Requests\BecaUpdateRequest $request
     * @param \App\Models\Beca $beca
     * @return \Illuminate\Http\Response
     */
    public function update(BecaUpdateRequest $request, Beca $beca)
    {
        $this->authorize('update', $beca);

        $validated = $request->validated();

        $beca->update($validated);

        return new BecaResource($beca);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Beca $beca
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Beca $beca)
    {
        $this->authorize('delete', $beca);

        $beca->delete();

        return response()->noContent();
    }
}
