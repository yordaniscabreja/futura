<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use App\Http\Resources\BecaResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\BecaCollection;

class AcademicProgramBecasController extends Controller
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

        $becas = $academicProgram
            ->becas()
            ->search($search)
            ->latest()
            ->paginate();

        return new BecaCollection($becas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AcademicProgram $academicProgram)
    {
        $this->authorize('create', Beca::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
        ]);

        $beca = $academicProgram->becas()->create($validated);

        return new BecaResource($beca);
    }
}
