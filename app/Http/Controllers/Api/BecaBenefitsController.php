<?php

namespace App\Http\Controllers\Api;

use App\Models\Beca;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BenefitResource;
use App\Http\Resources\BenefitCollection;

class BecaBenefitsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Beca $beca
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Beca $beca)
    {
        $this->authorize('view', $beca);

        $search = $request->get('search', '');

        $benefits = $beca
            ->benefits()
            ->search($search)
            ->latest()
            ->paginate();

        return new BenefitCollection($benefits);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Beca $beca
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Beca $beca)
    {
        $this->authorize('create', Benefit::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $benefit = $beca->benefits()->create($validated);

        return new BenefitResource($benefit);
    }
}
