<?php

namespace App\Http\Controllers;

use App\Models\Agreement;
use App\Models\University;
use Illuminate\Http\Request;
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
        $this->authorize('view-any', Agreement::class);

        $search = $request->get('search', '');

        $agreements = Agreement::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.agreements.index', compact('agreements', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Agreement::class);

        $universities = University::pluck('name', 'id');

        return view('app.agreements.create', compact('universities'));
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

        return redirect()
            ->route('agreements.edit', $agreement)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Agreement $agreement
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Agreement $agreement)
    {
        $this->authorize('view', $agreement);

        return view('app.agreements.show', compact('agreement'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Agreement $agreement
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Agreement $agreement)
    {
        $this->authorize('update', $agreement);

        $universities = University::pluck('name', 'id');

        return view(
            'app.agreements.edit',
            compact('agreement', 'universities')
        );
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

        return redirect()
            ->route('agreements.edit', $agreement)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('agreements.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
