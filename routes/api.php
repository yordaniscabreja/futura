<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ZoneController;
use App\Http\Controllers\Api\BecaController;
use App\Http\Controllers\Api\BondController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\CampusController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\AcademyController;
use App\Http\Controllers\Api\BenefitController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\EconomyController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\ModalityController;
use App\Http\Controllers\Api\PrestigeController;
use App\Http\Controllers\Api\RectoriaController;
use App\Http\Controllers\Api\WellnessController;
use App\Http\Controllers\Api\ConvenioController;
use App\Http\Controllers\Api\AgreementController;
use App\Http\Controllers\Api\BasicCoreController;
use App\Http\Controllers\Api\LifeStyleController;
use App\Http\Controllers\Api\MediaTypeController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\UniversityController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RequerimentController;
use App\Http\Controllers\Api\UserStudentsController;
use App\Http\Controllers\Api\BecaBenefitsController;
use App\Http\Controllers\Api\AcademicLevelController;
use App\Http\Controllers\Api\KnowledgeAreaController;
use App\Http\Controllers\Api\EducationLevelController;
use App\Http\Controllers\Api\AcademicProgramController;
use App\Http\Controllers\Api\InternalizationController;
use App\Http\Controllers\Api\StudentCommentsController;
use App\Http\Controllers\Api\CityUniversitiesController;
use App\Http\Controllers\Api\DepartmentCitiesController;
use App\Http\Controllers\Api\BecaRequerimentsController;
use App\Http\Controllers\Api\MediaTypeAllMediaController;
use App\Http\Controllers\Api\CountryDepartmentsController;
use App\Http\Controllers\Api\UniversityAllMediaController;
use App\Http\Controllers\Api\UniversityRectoriasController;
use App\Http\Controllers\Api\UniversityConveniosController;
use App\Http\Controllers\Api\AcademicProgramZonesController;
use App\Http\Controllers\Api\AcademicProgramBecasController;
use App\Http\Controllers\Api\AcademicProgramBondsController;
use App\Http\Controllers\Api\AcademicProgramCampusesController;
use App\Http\Controllers\Api\AcademicProgramStudentsController;
use App\Http\Controllers\Api\KnowledgeAreaBasicCoresController;
use App\Http\Controllers\Api\AcademicProgramEconomiesController;
use App\Http\Controllers\Api\AcademicProgramPrestigesController;
use App\Http\Controllers\Api\AcademicProgramAcademiesController;
use App\Http\Controllers\Api\ModalityAcademicProgramsController;
use App\Http\Controllers\Api\AcademicProgramLifeStylesController;
use App\Http\Controllers\Api\AcademicProgramWellnessesController;
use App\Http\Controllers\Api\BasicCoreAcademicProgramsController;
use App\Http\Controllers\Api\UniversityAcademicProgramsController;
use App\Http\Controllers\Api\AcademicLevelAcademicProgramsController;
use App\Http\Controllers\Api\EducationLevelAcademicProgramsController;
use App\Http\Controllers\Api\AcademicProgramInternalizationsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('api.')->group(function () {
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);

    Route::apiResource('countries', CountryController::class);

    // Country Departments
    Route::get('/countries/{country}/departments', [
        CountryDepartmentsController::class,
        'index',
    ])->name('countries.departments.index');
    Route::post('/countries/{country}/departments', [
        CountryDepartmentsController::class,
        'store',
    ])->name('countries.departments.store');

    Route::apiResource('cities', CityController::class);

    // City Universities
    Route::get('/cities/{city}/universities', [
        CityUniversitiesController::class,
        'index',
    ])->name('cities.universities.index');
    Route::post('/cities/{city}/universities', [
        CityUniversitiesController::class,
        'store',
    ])->name('cities.universities.store');

    Route::apiResource('departments', DepartmentController::class);

    // Department Cities
    Route::get('/departments/{department}/cities', [
        DepartmentCitiesController::class,
        'index',
    ])->name('departments.cities.index');
    Route::post('/departments/{department}/cities', [
        DepartmentCitiesController::class,
        'store',
    ])->name('departments.cities.store');

    Route::apiResource('academic-levels', AcademicLevelController::class);

    // AcademicLevel Academic Programs
    Route::get('/academic-levels/{academicLevel}/academic-programs', [
        AcademicLevelAcademicProgramsController::class,
        'index',
    ])->name('academic-levels.academic-programs.index');
    Route::post('/academic-levels/{academicLevel}/academic-programs', [
        AcademicLevelAcademicProgramsController::class,
        'store',
    ])->name('academic-levels.academic-programs.store');

    Route::apiResource('academic-programs', AcademicProgramController::class);

    // AcademicProgram Economies
    Route::get('/academic-programs/{academicProgram}/economies', [
        AcademicProgramEconomiesController::class,
        'index',
    ])->name('academic-programs.economies.index');
    Route::post('/academic-programs/{academicProgram}/economies', [
        AcademicProgramEconomiesController::class,
        'store',
    ])->name('academic-programs.economies.store');

    // AcademicProgram Life Styles
    Route::get('/academic-programs/{academicProgram}/life-styles', [
        AcademicProgramLifeStylesController::class,
        'index',
    ])->name('academic-programs.life-styles.index');
    Route::post('/academic-programs/{academicProgram}/life-styles', [
        AcademicProgramLifeStylesController::class,
        'store',
    ])->name('academic-programs.life-styles.store');

    // AcademicProgram Wellnesses
    Route::get('/academic-programs/{academicProgram}/wellnesses', [
        AcademicProgramWellnessesController::class,
        'index',
    ])->name('academic-programs.wellnesses.index');
    Route::post('/academic-programs/{academicProgram}/wellnesses', [
        AcademicProgramWellnessesController::class,
        'store',
    ])->name('academic-programs.wellnesses.store');

    // AcademicProgram Prestiges
    Route::get('/academic-programs/{academicProgram}/prestiges', [
        AcademicProgramPrestigesController::class,
        'index',
    ])->name('academic-programs.prestiges.index');
    Route::post('/academic-programs/{academicProgram}/prestiges', [
        AcademicProgramPrestigesController::class,
        'store',
    ])->name('academic-programs.prestiges.store');

    // AcademicProgram Internalizations
    Route::get('/academic-programs/{academicProgram}/internalizations', [
        AcademicProgramInternalizationsController::class,
        'index',
    ])->name('academic-programs.internalizations.index');
    Route::post('/academic-programs/{academicProgram}/internalizations', [
        AcademicProgramInternalizationsController::class,
        'store',
    ])->name('academic-programs.internalizations.store');

    // AcademicProgram Campuses
    Route::get('/academic-programs/{academicProgram}/campuses', [
        AcademicProgramCampusesController::class,
        'index',
    ])->name('academic-programs.campuses.index');
    Route::post('/academic-programs/{academicProgram}/campuses', [
        AcademicProgramCampusesController::class,
        'store',
    ])->name('academic-programs.campuses.store');

    // AcademicProgram Academies
    Route::get('/academic-programs/{academicProgram}/academies', [
        AcademicProgramAcademiesController::class,
        'index',
    ])->name('academic-programs.academies.index');
    Route::post('/academic-programs/{academicProgram}/academies', [
        AcademicProgramAcademiesController::class,
        'store',
    ])->name('academic-programs.academies.store');

    // AcademicProgram Zones
    Route::get('/academic-programs/{academicProgram}/zones', [
        AcademicProgramZonesController::class,
        'index',
    ])->name('academic-programs.zones.index');
    Route::post('/academic-programs/{academicProgram}/zones', [
        AcademicProgramZonesController::class,
        'store',
    ])->name('academic-programs.zones.store');

    // AcademicProgram Becas
    Route::get('/academic-programs/{academicProgram}/becas', [
        AcademicProgramBecasController::class,
        'index',
    ])->name('academic-programs.becas.index');
    Route::post('/academic-programs/{academicProgram}/becas', [
        AcademicProgramBecasController::class,
        'store',
    ])->name('academic-programs.becas.store');

    // AcademicProgram Bonds
    Route::get('/academic-programs/{academicProgram}/bonds', [
        AcademicProgramBondsController::class,
        'index',
    ])->name('academic-programs.bonds.index');
    Route::post('/academic-programs/{academicProgram}/bonds', [
        AcademicProgramBondsController::class,
        'store',
    ])->name('academic-programs.bonds.store');

    // AcademicProgram Students
    Route::get('/academic-programs/{academicProgram}/students', [
        AcademicProgramStudentsController::class,
        'index',
    ])->name('academic-programs.students.index');
    Route::post('/academic-programs/{academicProgram}/students', [
        AcademicProgramStudentsController::class,
        'store',
    ])->name('academic-programs.students.store');

    Route::apiResource('academies', AcademyController::class);

    Route::apiResource('agreements', AgreementController::class);

    Route::apiResource('basic-cores', BasicCoreController::class);

    // BasicCore Academic Programs
    Route::get('/basic-cores/{basicCore}/academic-programs', [
        BasicCoreAcademicProgramsController::class,
        'index',
    ])->name('basic-cores.academic-programs.index');
    Route::post('/basic-cores/{basicCore}/academic-programs', [
        BasicCoreAcademicProgramsController::class,
        'store',
    ])->name('basic-cores.academic-programs.store');

    Route::apiResource('benefits', BenefitController::class);

    Route::apiResource('comments', CommentController::class);

    Route::apiResource('internalizations', InternalizationController::class);

    Route::apiResource('education-levels', EducationLevelController::class);

    // EducationLevel Academic Programs
    Route::get('/education-levels/{educationLevel}/academic-programs', [
        EducationLevelAcademicProgramsController::class,
        'index',
    ])->name('education-levels.academic-programs.index');
    Route::post('/education-levels/{educationLevel}/academic-programs', [
        EducationLevelAcademicProgramsController::class,
        'store',
    ])->name('education-levels.academic-programs.store');

    Route::apiResource('knowledge-areas', KnowledgeAreaController::class);

    // KnowledgeArea Basic Cores
    Route::get('/knowledge-areas/{knowledgeArea}/basic-cores', [
        KnowledgeAreaBasicCoresController::class,
        'index',
    ])->name('knowledge-areas.basic-cores.index');
    Route::post('/knowledge-areas/{knowledgeArea}/basic-cores', [
        KnowledgeAreaBasicCoresController::class,
        'store',
    ])->name('knowledge-areas.basic-cores.store');

    Route::apiResource('life-styles', LifeStyleController::class);

    Route::apiResource('media-types', MediaTypeController::class);

    // MediaType Multimedias
    Route::get('/media-types/{mediaType}/all-media', [
        MediaTypeAllMediaController::class,
        'index',
    ])->name('media-types.all-media.index');
    Route::post('/media-types/{mediaType}/all-media', [
        MediaTypeAllMediaController::class,
        'store',
    ])->name('media-types.all-media.store');

    Route::apiResource('modalities', ModalityController::class);

    // Modality Academic Programs
    Route::get('/modalities/{modality}/academic-programs', [
        ModalityAcademicProgramsController::class,
        'index',
    ])->name('modalities.academic-programs.index');
    Route::post('/modalities/{modality}/academic-programs', [
        ModalityAcademicProgramsController::class,
        'store',
    ])->name('modalities.academic-programs.store');

    Route::apiResource('prestiges', PrestigeController::class);

    Route::apiResource('campuses', CampusController::class);

    Route::apiResource('economies', EconomyController::class);

    Route::apiResource('rectorias', RectoriaController::class);

    Route::apiResource('requeriments', RequerimentController::class);

    Route::apiResource('students', StudentController::class);

    // Student Comments
    Route::get('/students/{student}/comments', [
        StudentCommentsController::class,
        'index',
    ])->name('students.comments.index');
    Route::post('/students/{student}/comments', [
        StudentCommentsController::class,
        'store',
    ])->name('students.comments.store');

    Route::apiResource('users', UserController::class);

    // User Students
    Route::get('/users/{user}/students', [
        UserStudentsController::class,
        'index',
    ])->name('users.students.index');
    Route::post('/users/{user}/students', [
        UserStudentsController::class,
        'store',
    ])->name('users.students.store');

    Route::apiResource('wellnesses', WellnessController::class);

    Route::apiResource('zones', ZoneController::class);

    Route::apiResource('all-media', MediaController::class);

    Route::apiResource('becas', BecaController::class);

    // Beca Requeriments
    Route::get('/becas/{beca}/requeriments', [
        BecaRequerimentsController::class,
        'index',
    ])->name('becas.requeriments.index');
    Route::post('/becas/{beca}/requeriments', [
        BecaRequerimentsController::class,
        'store',
    ])->name('becas.requeriments.store');

    // Beca Benefits
    Route::get('/becas/{beca}/benefits', [
        BecaBenefitsController::class,
        'index',
    ])->name('becas.benefits.index');
    Route::post('/becas/{beca}/benefits', [
        BecaBenefitsController::class,
        'store',
    ])->name('becas.benefits.store');

    Route::apiResource('bonds', BondController::class);

    Route::apiResource('convenios', ConvenioController::class);

    Route::apiResource('universities', UniversityController::class);
    /**
     * Inicio Rutas personalizadas para extraer datos de las universidades
     * ////////////////////////////////////////////////////////////////////
     */
    //Return universidades Convenio
    Route::get('/universidadesConvenio', [
        UniversityController::class,
        'universidadesConvenio',
    ])->name('universities.universidadesConvenio');

    //virtualProgramInformation
    Route::get('/virtualProgramInformation/{university_id}', [
        UniversityController::class,
        'virtualProgramInformation',
    ])->name('universities.virtualProgramInformation');

    //Programas academicos de una universidad con datos de modality, academic_level y education_level
    Route::get('/programasUniversidad/{university_id}', [
        UniversityController::class,
        'programasUniversidad',
    ])->name('universities.programasUniversidad');
    //Comentarios de una universidad
    Route::get('/comentariosUniversidad/{university_id}', [
        UniversityController::class,
        'comentariosUniversidad',
    ])->name('universities.comentariosUniversidad');
    //Becas de una universidad
    Route::get('/becasUniversidad/{university_id}', [
        UniversityController::class,
        'becasUniversidad',
    ])->name('universities.becasUniversidad');

    //Dimensiones de una universidad
    Route::get('/dimensionesUniversidad/{university_id}', [
        UniversityController::class,
        'dimensionesUniversidad',
    ])->name('universities.dimensionesUniversidad');

    //programas de universidades convenio futura
    Route::get('/programasConvenio', [
        UniversityController::class,
        'programasConvenio',
    ])->name('universities.programasConvenio');

//programas con detalles
Route::get('/academicProgramDetails/{program_id}', [
    AcademicProgramController::class,
    'academicProgramDetails',
])->name('academicProgram.academicProgramDetails');

//Comentarios de un programa con detalles
Route::get('/comentariosPrograma/{program_id}', [
    AcademicProgramController::class,
    'comentariosPrograma',
])->name('academicProgram.comentariosPrograma');
    /**
     * ////////////////////////////////////////////////////////////////
    * Fin Rutas personalizadas para extraer datos de las universidades
    */

    // University Academic Programs
    Route::get('/universities/{university}/academic-programs', [
        UniversityAcademicProgramsController::class,
        'index',
    ])->name('universities.academic-programs.index');
    Route::post('/universities/{university}/academic-programs', [
        UniversityAcademicProgramsController::class,
        'store',
    ])->name('universities.academic-programs.store');

    // University Rectorias
    Route::get('/universities/{university}/rectorias', [
        UniversityRectoriasController::class,
        'index',
    ])->name('universities.rectorias.index');
    Route::post('/universities/{university}/rectorias', [
        UniversityRectoriasController::class,
        'store',
    ])->name('universities.rectorias.store');

    // University All Media
    Route::get('/universities/{university}/all-media', [
        UniversityAllMediaController::class,
        'index',
    ])->name('universities.all-media.index');
    Route::post('/universities/{university}/all-media', [
        UniversityAllMediaController::class,
        'store',
    ])->name('universities.all-media.store');

    // University Convenios
    Route::get('/universities/{university}/convenios', [
        UniversityConveniosController::class,
        'index',
    ])->name('universities.convenios.index');
    Route::post('/universities/{university}/convenios', [
        UniversityConveniosController::class,
        'store',
    ])->name('universities.convenios.store');
});
