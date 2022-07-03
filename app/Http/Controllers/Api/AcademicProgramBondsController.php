<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use App\Http\Resources\BondResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\BondCollection;

class AcademicProgramBondsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, AcademicProgram $academicProgram)
    {
        $this->authorize('view', $academicProgram);

        $search = $request->get('search', '');

        $bonds = $academicProgram
            ->bonds()
            ->search($search)
            ->latest()
            ->paginate();

        return new BondCollection($bonds);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AcademicProgram $academicProgram)
    {
        $this->authorize('create', Bond::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $bond = $academicProgram->bonds()->create($validated);

        return new BondResource($bond);
    }
}
