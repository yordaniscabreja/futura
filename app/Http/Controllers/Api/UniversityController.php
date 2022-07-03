<?php

namespace App\Http\Controllers\Api;

use App\Models\University;
use App\Models\AcademicProgram;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\UniversityResource;
use App\Http\Resources\UniversityCollection;
use App\Http\Resources\AcademicProgramCollection;
use App\Http\Requests\UniversityStoreRequest;
use App\Http\Requests\UniversityUpdateRequest;

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

         //TODO: Mostrar los datos correctamente y selecciona solo los que debo mostrar. Añadir los mensajes a la coleccion.
       $universities = $university::with("city:id,name")->with("rectorias")->where('id',$university->id)->get();
       $comments = $university->students()->with('user:id,name')->with('comments')->get();
      // TODO> Mostrar solo el nombre del estudiante con todos los comentarios

      $universitat = $universities->concat($comments);
       return new UniversityCollection($universitat);
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
        $this->authorize('update', $university);

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function virtualProgramInformation(Request $request)
    {
        $academicPrograms = AcademicProgram::where('university_id',$request->university_id)
            ->where('modality_id', 10)->get();
               return new AcademicProgramCollection($academicPrograms);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function programasUniversidad(Request $request)
    {
        $academicPrograms = AcademicProgram::where('university_id',$request->university_id)
            ->with('modality',)->with('educationLevel')->with('academicLevel')->get();
               return new AcademicProgramCollection($academicPrograms);
    }
}
