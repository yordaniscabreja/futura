<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $this->authorize('view-any', University::class);

        $search = $request->get('search', '');

        $universities = University::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.universities.index',
            compact('universities', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', University::class);

        $cities = City::pluck('name', 'id');

        return view('app.universities.create', compact('cities'));
    }

    /**
     * @param \App\Http\Requests\UniversityStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UniversityStoreRequest $request)
    {
        $this->authorize('create', University::class);

        $validated = $request->validated();
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('public');
        }

        if ($request->hasFile('about_video_url')) {
            $validated['about_video_url'] = $request
                ->file('about_video_url')
                ->store('public');
        }

        if ($request->hasFile('background_image')) {
            $validated['background_image'] = $request
                ->file('background_image')
                ->store('public');
        }

        $university = University::create($validated);

        return redirect()
            ->route('universities.edit', $university)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, University $university)
    {
        $this->authorize('view', $university);

        return view('app.universities.show', compact('university'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, University $university)
    {
        $this->authorize('update', $university);

        $cities = City::pluck('name', 'id');

        return view('app.universities.edit', compact('university', 'cities'));
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
        if ($request->hasFile('logo')) {
            if ($university->logo) {
                Storage::delete($university->logo);
            }

            $validated['logo'] = $request->file('logo')->store('public');
        }

        if ($request->hasFile('about_video_url')) {
            if ($university->about_video_url) {
                Storage::delete($university->about_video_url);
            }

            $validated['about_video_url'] = $request
                ->file('about_video_url')
                ->store('public');
        }

        if ($request->hasFile('background_image')) {
            if ($university->background_image) {
                Storage::delete($university->background_image);
            }

            $validated['background_image'] = $request
                ->file('background_image')
                ->store('public');
        }

        $university->update($validated);

        return redirect()
            ->route('universities.edit', $university)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, University $university)
    {
        $this->authorize('delete', $university);

        if ($university->logo) {
            Storage::delete($university->logo);
        }

        if ($university->about_video_url) {
            Storage::delete($university->about_video_url);
        }

        if ($university->background_image) {
            Storage::delete($university->background_image);
        }

        $university->delete();

        return redirect()
            ->route('universities.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
