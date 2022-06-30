<?php

namespace App\Http\Controllers\Api;

use App\Models\Beca;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RequerimentResource;
use App\Http\Resources\RequerimentCollection;

class BecaRequerimentsController extends Controller
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

        $requeriments = $beca
            ->requeriments()
            ->search($search)
            ->latest()
            ->paginate();

        return new RequerimentCollection($requeriments);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Beca $beca
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Beca $beca)
    {
        $this->authorize('create', Requeriment::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $requeriment = $beca->requeriments()->create($validated);

        return new RequerimentResource($requeriment);
    }
}
