<?php

namespace App\Http\Controllers\Api;

use App\Models\Academy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AcademyResource;
use App\Http\Resources\AcademyCollection;
use App\Http\Requests\AcademyStoreRequest;
use App\Http\Requests\AcademyUpdateRequest;

class AcademyController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Academy::class);

        $search = $request->get('search', '');

        $academies = Academy::search($search)
            ->latest()
            ->paginate();

        return new AcademyCollection($academies);
    }

    /**
     * @param \App\Http\Requests\AcademyStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcademyStoreRequest $request)
    {
        $this->authorize('create', Academy::class);

        $validated = $request->validated();

        $academy = Academy::create($validated);

        return new AcademyResource($academy);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Academy $academy
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Academy $academy)
    {
        $this->authorize('view', $academy);

        return new AcademyResource($academy);
    }

    /**
     * @param \App\Http\Requests\AcademyUpdateRequest $request
     * @param \App\Models\Academy $academy
     * @return \Illuminate\Http\Response
     */
    public function update(AcademyUpdateRequest $request, Academy $academy)
    {
        $this->authorize('update', $academy);

        $validated = $request->validated();

        $academy->update($validated);

        return new AcademyResource($academy);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Academy $academy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Academy $academy)
    {
        $this->authorize('delete', $academy);

        $academy->delete();

        return response()->noContent();
    }
}
