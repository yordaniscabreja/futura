<?php

namespace App\Http\Controllers\Api;

use App\Models\Agreement;
use Illuminate\Http\Request;
use App\Http\Resources\BondResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\BondCollection;

class AgreementBondsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Agreement $agreement
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Agreement $agreement)
    {
       // $this->authorize('view', $agreement);

        $search = $request->get('search', '');

        $bonds = $agreement
            ->bonuses()
            ->search($search)
            ->latest()
            ->paginate();

        return new BondCollection($bonds);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Agreement $agreement
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Agreement $agreement)
    {
        $this->authorize('create', Bond::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $bond = $agreement->bonuses()->create($validated);

        return new BondResource($bond);
    }
}
