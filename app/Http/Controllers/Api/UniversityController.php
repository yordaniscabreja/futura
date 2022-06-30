<?php

namespace App\Http\Controllers\Api;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\UniversityResource;
use App\Http\Resources\UniversityCollection;
use App\Http\Requests\UniversityStoreRequest;
use App\Http\Requests\UniversityUpdateRequest;

class UniversityController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$this->authorize('view-any', University::class);

        $search = $request->get('search', '');

        $universities = University::search($search)
            ->latest()
            ->paginate();

        return new UniversityCollection($universities);
    }

    /**
     * @param \App\Http\Requests\UniversityStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UniversityStoreRequest $request)
    {
        $this->authorize('create', University::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $university = University::create($validated);

        return new UniversityResource($university);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, University $university)
    {
       // $this->authorize('view', $university);

        return new UniversityResource($university);
    }

    /**
     * @param \App\Http\Requests\UniversityUpdateRequest $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function update(
        UniversityUpdateRequest $request,
        University $university
    ) {
        $this->authorize('update', $university);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($university->image) {
                Storage::delete($university->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $university->update($validated);

        return new UniversityResource($university);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, University $university)
    {
        $this->authorize('delete', $university);

        if ($university->image) {
            Storage::delete($university->image);
        }

        $university->delete();

        return response()->noContent();
    }
}
