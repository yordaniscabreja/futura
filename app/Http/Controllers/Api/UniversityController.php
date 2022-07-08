<?php

namespace App\Http\Controllers\Api;

use App\Models\University;
use App\Models\AcademicProgram;
use App\Models\Comment;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\UniversityResource;
use App\Http\Resources\UniversityCollection;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\AcademicProgramCollection;
use App\Http\Resources\BecaCollection;
use App\Http\Resources\AcademicProgramResource;
use App\Http\Requests\UniversityStoreRequest;
use App\Http\Requests\UniversityUpdateRequest;
use App\Http\Resources\StudentCollection;

class UniversityController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$this->authorize('view-any', University::class);

        $search = $request->get('search', '');

        $universities = University::search($search)
            ->latest()
            ->paginate();

        return new UniversityCollection($universities);
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

        return new UniversityResource($university);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, University $university)
    {
        //$this->authorize('view', $university);

        $universities = $university::with("city:id,name")->with("rectorias")->with("convenios")->with(
            [
                'allMedia' => function ($q) {
                    $q->with("mediaType:id,type");
                }
            ]
        )->where('id', $university->id)->get();
        $tmp = $universities[0]['logo'];
        $tmp1 = $universities[0]['background_image'];
        $universities[0]['logo'] = Storage::url($tmp);
        $universities[0]['background_image'] = Storage::url($tmp1);
        return new UniversityCollection($universities);
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
        //$this->authorize('update', $university);

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

        return new UniversityResource($university);
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

        return response()->noContent();
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    function universidadesConvenio()
    {
        $universities = University::with("agreement")->has('agreement')->get();
        return new UniversityCollection($universities);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    function programasConvenio()
    {
        $academicPrograms = AcademicProgram::with(
                [
                    'university' => function ($q) {
                        $q->has("agreement");
                        $q->with("city");
                    }
                ]
            )->with('modality')
            ->get();

       /* $academicPrograms = AcademicProgram::where('university_id', $request->university_id)
            ->where('modality_id', 10)->get();*/
        return new AcademicProgramCollection($academicPrograms);
        /*$universities = University::has('agreement')->academicProgramas()->where('id', $request->university_id)->get();
        return new UniversityCollection($universities);*/
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function virtualProgramInformation(Request $request)
    {
        $academicPrograms = AcademicProgram::where('university_id', $request->university_id)
            ->where('modality_id', 10)->get();
        return new AcademicProgramCollection($academicPrograms);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function programasUniversidad(Request $request)
    {
        $academicPrograms = AcademicProgram::where('university_id', $request->university_id)
            ->with('modality',)->with('educationLevel')->with('academicLevel')->get();
        return new AcademicProgramCollection($academicPrograms);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function comentariosUniversidad(Request $request, University $university)
    {
        $academicPrograms = AcademicProgram::where('university_id', $request->university_id)
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function becasUniversidad(Request $request, University $university)
    {
        $academicPrograms = AcademicProgram::where('university_id', $request->university_id)
            ->with('becas')
            ->get();

        $becas = $academicPrograms[0]['becas'];

        return new BecaCollection($becas);
    }

/**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\University $university
     * @return \Illuminate\Http\Response
     */
    public function dimensionesUniversidad(Request $request, University $university)
    {
        $academicPrograms = AcademicProgram::where('university_id', $request->university_id)
            ->with('academies')
            ->with('campuses')
            ->with('economies')
            ->with('internalizations')
            ->with('lifeStyles')
            ->with('wellnesses')
            ->with('prestiges')
            ->with('zones')
            ->get();

            $academies = [];
            foreach ($academicPrograms as $value) {

                $academies[] = $value['academies'];
            }

            $sumaPlanEstudio = 0;
            $sumaRecursosAcademicos = 0;
            $sumaTecnologia = 0;
            $sumaTamanoGrupos = 0;
            $sumaExcelenciaProfesores = 0;

            foreach ($academies as $value) {
                $sumaPlanEstudio += $value('plan_estudio');
                $sumaRecursosAcademicos += $value('recursos_academicos');
                $sumaTecnologia += $value('tecnologia');
                $sumaTamanoGrupos += $value('tamano_grupos');
                $sumaExcelenciaProfesores += $value('excelencia_profesores');
            }

            $divisorAcademies = $academies.length();

            $promedioPlanEstudio = 0;
            $promedioRecursosAcademicos = 0;
            $promedioTecnologia = 0;
            $promedioTamanoGrupos = 0;
            $promedioExcelenciaProfesores = 0;

            $promedioDimAcademia = $academies;

            $campuses = [];
            foreach ($academicPrograms as $key => $value) {

                $campuses[] = $value['campuses'];
            }
            $economies = [];
            foreach ($academicPrograms as $key => $value) {

                $economies[] = $value['economies'];
            }
            $internalizations = [];
            foreach ($academicPrograms as $key => $value) {

                $internalizations[] = $value['internalizations'];
            }
            $lifeStyles = [];
            foreach ($academicPrograms as $key => $value) {

                $lifeStyles[] = $value['lifeStyles'];
            }
            $wellnesses = [];
            foreach ($academicPrograms as $key => $value) {

                $wellnesses[] = $value['wellnesses'];
            }
            $prestiges = [];
            foreach ($academicPrograms as $key => $value) {

                $prestiges[] = $value['prestiges'];
            }
            $zones = [];
            foreach ($academicPrograms as $key => $value) {

                $zones[] = $value['zones'];
            }

        return new AcademicProgramCollection($academies);
    }

    /**
     * OST            api/academic-programs/{academicProgram}/academies api.academic-programs.academies.store › Api\AcademicProgramAcademiesCo…
  GET|HEAD        api/academic-programs/{academicProgram}/becas api.academic-programs.becas.index › Api\AcademicProgramBecasController@ind…
  POST            api/academic-programs/{academicProgram}/becas api.academic-programs.becas.store › Api\AcademicProgramBecasController@sto…
  GET|HEAD        api/academic-programs/{academicProgram}/bonds api.academic-programs.bonds.index › Api\AcademicProgramBondsController@ind…
  POST            api/academic-programs/{academicProgram}/bonds api.academic-programs.bonds.store › Api\AcademicProgramBondsController@sto…
  GET|HEAD        api/academic-programs/{academicProgram}/campuses api.academic-programs.campuses.index › Api\AcademicProgramCampusesContr…
  POST            api/academic-programs/{academicProgram}/campuses api.academic-programs.campuses.store › Api\AcademicProgramCampusesContr…
  GET|HEAD        api/academic-programs/{academicProgram}/economies api.academic-programs.economies.index › Api\AcademicProgramEconomiesCo…
  POST            api/academic-programs/{academicProgram}/economies api.academic-programs.economies.store › Api\AcademicProgramEconomiesCo…
  GET|HEAD        api/academic-programs/{academicProgram}/internalizations api.academic-programs.internalizations.index › Api\AcademicProg…
  POST            api/academic-programs/{academicProgram}/internalizations api.academic-programs.internalizations.store › Api\AcademicProg…
  GET|HEAD        api/academic-programs/{academicProgram}/life-styles api.academic-programs.life-styles.index › Api\AcademicProgramLifeSty…
  POST            api/academic-programs/{academicProgram}/life-styles api.academic-programs.life-styles.store › Api\AcademicProgramLifeSty…
  GET|HEAD        api/academic-programs/{academicProgram}/prestiges api.academic-programs.prestiges.index › Api\AcademicProgramPrestigesCo…
  POST            api/academic-programs/{academicProgram}/prestiges api.academic-programs.prestiges.store › Api\AcademicProgramPrestigesCo…
  GET|HEAD        api/academic-programs/{academicProgram}/students api.academic-programs.students.index › Api\AcademicProgramStudentsContr…
  POST            api/academic-programs/{academicProgram}/students api.academic-programs.students.store › Api\AcademicProgramStudentsContr…
  GET|HEAD        api/academic-programs/{academicProgram}/wellnesses api.academic-programs.wellnesses.index › Api\AcademicProgramWellnesse…
  POST            api/academic-programs/{academicProgram}/wellnesses api.academic-programs.wellnesses.store › Api\AcademicProgramWellnesse…
  GET|HEAD        api/academic-programs/{academicProgram}/zones api.academic-programs.zones.index › Api\AcademicProgramZonesController@ind…
  POST            api/academic-programs/{academicProgram}/zones api.academic-programs.zones.store › Api\AcademicProgramZonesController@sto…
  GET|HEAD        a
     *
     *
     */
}
