<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Requests\CountryStoreRequest;
use App\Http\Requests\CountryUpdateRequest;

class CountryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Country::class);

        $search = $request->get('search', '');

        $countries = Country::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.countries.index', compact('countries', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Country::class);

        return view('app.countries.create');
    }

    /**
     * @param \App\Http\Requests\CountryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryStoreRequest $request)
    {
        $this->authorize('create', Country::class);

        $validated = $request->validated();

        $country = Country::create($validated);

        return redirect()
            ->route('countries.edit', $country)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Country $country)
    {
        $this->authorize('view', $country);

        return view('app.countries.show', compact('country'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Country $country)
    {
        $this->authorize('update', $country);

        return view('app.countries.edit', compact('country'));
    }

    /**
     * @param \App\Http\Requests\CountryUpdateRequest $request
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function update(CountryUpdateRequest $request, Country $country)
    {
        $this->authorize('update', $country);

        $validated = $request->validated();

        $country->update($validated);

        return redirect()
            ->route('countries.edit', $country)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Country $country)
    {
        $this->authorize('delete', $country);

        $country->delete();

        return redirect()
            ->route('countries.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
