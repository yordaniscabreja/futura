<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\AcademicProgram;
use App\Http\Controllers\Controller;
use App\Http\Resources\AcademicProgramResource;
use App\Http\Resources\AcademicProgramCollection;
use App\Http\Resources\CommentCollection;
use App\Http\Requests\AcademicProgramStoreRequest;
use App\Http\Requests\AcademicProgramUpdateRequest;

class AcademicProgramController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // $this->authorize('view-any', AcademicProgram::class);

        $search = $request->get('search', '');

        $academicPrograms = AcademicProgram::search($search)
            ->latest()
            ->paginate();

        return new AcademicProgramCollection($academicPrograms);
    }

    /**
     * @param \App\Http\Requests\AcademicProgramStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcademicProgramStoreRequest $request)
    {
        $this->authorize('create', AcademicProgram::class);

        $validated = $request->validated();

        $academicProgram = AcademicProgram::create($validated);

        return new AcademicProgramResource($academicProgram);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, AcademicProgram $academicProgram)
    {
        //$this->authorize('view', $academicProgram);

        return new AcademicProgramResource($academicProgram);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function academicProgramDetails(Request $request, AcademicProgram $academicProgram)
    {
       $academicPrograms = $academicProgram->where('id', $request->program_id)
        ->with( ['university','modality','academicLevel','educationLevel','becas','bonds'])
        ->get();

   /* $academicPrograms = AcademicProgram::where('university_id', $request->university_id)
        ->where('modality_id', 10)->get();*/
    return new AcademicProgramCollection($academicPrograms);
    }

/**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function comentariosPrograma(Request $request, AcademicProgram $academicProgram)
    {
        $academicPrograms = $academicProgram->where('id', $request->program_id)
            ->with(
                [
                    'students' => function ($q) {
                        $q->with("comments");
                        $q->with("user:id,name");
                    }
                ]
            )
            ->get();

        $estudiantes = $academicPrograms[0]['students'];
        $comentarios = [];
        foreach ($estudiantes as $key => $value) {
            $value['comments']['name'] = $value['user']['name'];
            $value['comments']['semestre'] = $value['semestre'];

            $comentarios[] = $value['comments'];
        }
        return new CommentCollection($comentarios);
    }

    /**
     * @param \App\Http\Requests\AcademicProgramUpdateRequest $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function update(
        AcademicProgramUpdateRequest $request,
        AcademicProgram $academicProgram
    ) {
        $this->authorize('update', $academicProgram);

        $validated = $request->validated();

        $academicProgram->update($validated);

        return new AcademicProgramResource($academicProgram);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AcademicProgram $academicProgram
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, AcademicProgram $academicProgram)
    {
        $this->authorize('delete', $academicProgram);

        $academicProgram->delete();

        return response()->noContent();
    }
}
