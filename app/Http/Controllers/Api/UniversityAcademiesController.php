<?php

namespace App\Http\Controllers\Api;

use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AcademyResource;
use App\Http\Resources\AcademyCollection;

class UniversityAcademiesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, University $university)
    {
       // $this->authorize('view', $university);

        $search = $request->get('search', '');

        $academies = $university
            ->academies()
            ->search($search)
            ->latest()
            ->paginate();

        return new AcademyCollection($academies);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, University $university)
    {
        $this->authorize('create', Academy::class);

        $validated = $request->validate([
            'plan_estudio' => ['required', 'numeric'],
            'recursos_academicos' => ['required', 'numeric'],
            'tecnologia' => ['required', 'numeric'],
            'tamano_grupos' => ['required', 'numeric'],
            'excelencia_profesores' => ['required', 'numeric'],
        ]);

        $academy = $university->academies()->create($validated);

        return new AcademyResource($academy);
    }
}
