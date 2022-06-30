<?php

namespace App\Http\Controllers\Api;

use App\Models\Benefit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BenefitResource;
use App\Http\Resources\BenefitCollection;
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
            ->paginate();

        return new BenefitCollection($benefits);
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

        return new BenefitResource($benefit);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Benefit $benefit
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Benefit $benefit)
    {
        $this->authorize('view', $benefit);

        return new BenefitResource($benefit);
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

        return new BenefitResource($benefit);
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

        return response()->noContent();
    }
}
