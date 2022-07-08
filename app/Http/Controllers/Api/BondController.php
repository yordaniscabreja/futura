<?php

namespace App\Http\Controllers\Api;

use App\Models\Bond;
use Illuminate\Http\Request;
use App\Http\Resources\BondResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\BondCollection;
use App\Http\Requests\BondStoreRequest;
use App\Http\Requests\BondUpdateRequest;

class BondController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //  $this->authorize('view-any', Bond::class);

        $search = $request->get('search', '');

        $bonds = Bond::search($search)
            ->latest()
            ->paginate();

        return new BondCollection($bonds);
    }

    /**
     * @param \App\Http\Requests\BondStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BondStoreRequest $request)
    {
        $this->authorize('create', Bond::class);

        $validated = $request->validated();

        $bond = Bond::create($validated);

        return new BondResource($bond);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bond $bond
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Bond $bond)
    {
       // $this->authorize('view', $bond);

        return new BondResource($bond);
    }

    /**
     * @param \App\Http\Requests\BondUpdateRequest $request
     * @param \App\Models\Bond $bond
     * @return \Illuminate\Http\Response
     */
    public function update(BondUpdateRequest $request, Bond $bond)
    {
        $this->authorize('update', $bond);

        $validated = $request->validated();

        $bond->update($validated);

        return new BondResource($bond);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bond $bond
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Bond $bond)
    {
        $this->authorize('delete', $bond);

        $bond->delete();

        return response()->noContent();
    }
}
