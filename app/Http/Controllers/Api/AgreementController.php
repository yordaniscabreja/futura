<?php

namespace App\Http\Controllers\Api;

use App\Models\Agreement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgreementResource;
use App\Http\Resources\AgreementCollection;
use App\Http\Requests\AgreementStoreRequest;
use App\Http\Requests\AgreementUpdateRequest;

class AgreementController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$this->authorize('view-any', Agreement::class);

        $search = $request->get('search', '');

        $agreements = Agreement::search($search)
            ->latest()
            ->paginate();

        return new AgreementCollection($agreements);
    }

    /**
     * @param \App\Http\Requests\AgreementStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgreementStoreRequest $request)
    {
        $this->authorize('create', Agreement::class);

        $validated = $request->validated();

        $agreement = Agreement::create($validated);

        return new AgreementResource($agreement);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Agreement $agreement
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Agreement $agreement)
    {
       //$this->authorize('view', $agreement);

        return new AgreementResource($agreement);
    }

    /**
     * @param \App\Http\Requests\AgreementUpdateRequest $request
     * @param \App\Models\Agreement $agreement
     * @return \Illuminate\Http\Response
     */
    public function update(
        AgreementUpdateRequest $request,
        Agreement $agreement
    ) {
        $this->authorize('update', $agreement);

        $validated = $request->validated();

        $agreement->update($validated);

        return new AgreementResource($agreement);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Agreement $agreement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Agreement $agreement)
    {
        $this->authorize('delete', $agreement);

        $agreement->delete();

        return response()->noContent();
    }
}
