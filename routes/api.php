<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\BecaController;
use App\Http\Controllers\Api\BondController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ZoneController;
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
use App\Http\Controllers\Api\AgreementController;
use App\Http\Controllers\Api\BasicCoreController;
use App\Http\Controllers\Api\LifeStyleController;
use App\Http\Controllers\Api\MediaTypeController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\UniversityController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\RequerimentController;
use App\Http\Controllers\Api\BecaBenefitsController;
use App\Http\Controllers\Api\UserStudentsController;
use App\Http\Controllers\Api\AcademicLevelController;
use App\Http\Controllers\Api\KnowledgeAreaController;
use App\Http\Controllers\Api\AgreementBondsController;
use App\Http\Controllers\Api\EducationLevelController;
use App\Http\Controllers\Api\AcademicProgramController;
use App\Http\Controllers\Api\InternalizationController;
use App\Http\Controllers\Api\StudentCommentsController;
use App\Http\Controllers\Api\UniversityZonesController;
use App\Http\Controllers\Api\UniversityBecasController;
use App\Http\Controllers\Api\CityUniversitiesController;
use App\Http\Controllers\Api\DepartmentCitiesController;
use App\Http\Controllers\Api\BecaRequerimentsController;
use App\Http\Controllers\Api\MediaTypeAllMediaController;
use App\Http\Controllers\Api\CountryDepartmentsController;
use App\Http\Controllers\Api\UniversityCampusesController;
use App\Http\Controllers\Api\UniversityStudentsController;
use App\Http\Controllers\Api\UniversityAllMediaController;
use App\Http\Controllers\Api\UniversityAcademiesController;
use App\Http\Controllers\Api\UniversityPrestigesController;
use App\Http\Controllers\Api\UniversityEconomiesController;
use App\Http\Controllers\Api\UniversityRectoriasController;
use App\Http\Controllers\Api\UniversityLifeStylesController;
use App\Http\Controllers\Api\UniversityWellnessesController;
use App\Http\Controllers\Api\KnowledgeAreaBasicCoresController;
use App\Http\Controllers\Api\ModalityAcademicProgramsController;
use App\Http\Controllers\Api\BasicCoreAcademicProgramsController;
use App\Http\Controllers\Api\UniversityAcademicProgramsController;
use App\Http\Controllers\Api\UniversityInternalizationsController;
use App\Http\Controllers\Api\AcademicLevelAcademicProgramsController;
use App\Http\Controllers\Api\EducationLevelAcademicProgramsController;

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

    Route::apiResource('academies', AcademyController::class);

    Route::apiResource('agreements', AgreementController::class);

    // Agreement Bonuses
    Route::get('/agreements/{agreement}/bonds', [
        AgreementBondsController::class,
        'index',
    ])->name('agreements.bonds.index');
    Route::post('/agreements/{agreement}/bonds', [
        AgreementBondsController::class,
        'store',
    ])->name('agreements.bonds.store');

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

    Route::apiResource('benefits', BenefitController::class);

    Route::apiResource('bonds', BondController::class);

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

    Route::apiResource('universities', UniversityController::class);

    // University Academic Programs
    Route::get('/universities/{university}/academic-programs', [
        UniversityAcademicProgramsController::class,
        'index',
    ])->name('universities.academic-programs.index');
    Route::post('/universities/{university}/academic-programs', [
        UniversityAcademicProgramsController::class,
        'store',
    ])->name('universities.academic-programs.store');

    // University Zones
    Route::get('/universities/{university}/zones', [
        UniversityZonesController::class,
        'index',
    ])->name('universities.zones.index');
    Route::post('/universities/{university}/zones', [
        UniversityZonesController::class,
        'store',
    ])->name('universities.zones.store');

    // University Campuses
    Route::get('/universities/{university}/campuses', [
        UniversityCampusesController::class,
        'index',
    ])->name('universities.campuses.index');
    Route::post('/universities/{university}/campuses', [
        UniversityCampusesController::class,
        'store',
    ])->name('universities.campuses.store');

    // University Academies
    Route::get('/universities/{university}/academies', [
        UniversityAcademiesController::class,
        'index',
    ])->name('universities.academies.index');
    Route::post('/universities/{university}/academies', [
        UniversityAcademiesController::class,
        'store',
    ])->name('universities.academies.store');

    // University Prestiges
    Route::get('/universities/{university}/prestiges', [
        UniversityPrestigesController::class,
        'index',
    ])->name('universities.prestiges.index');
    Route::post('/universities/{university}/prestiges', [
        UniversityPrestigesController::class,
        'store',
    ])->name('universities.prestiges.store');

    // University Internalizations
    Route::get('/universities/{university}/internalizations', [
        UniversityInternalizationsController::class,
        'index',
    ])->name('universities.internalizations.index');
    Route::post('/universities/{university}/internalizations', [
        UniversityInternalizationsController::class,
        'store',
    ])->name('universities.internalizations.store');

    // University Economies
    Route::get('/universities/{university}/economies', [
        UniversityEconomiesController::class,
        'index',
    ])->name('universities.economies.index');
    Route::post('/universities/{university}/economies', [
        UniversityEconomiesController::class,
        'store',
    ])->name('universities.economies.store');

    // University Life Styles
    Route::get('/universities/{university}/life-styles', [
        UniversityLifeStylesController::class,
        'index',
    ])->name('universities.life-styles.index');
    Route::post('/universities/{university}/life-styles', [
        UniversityLifeStylesController::class,
        'store',
    ])->name('universities.life-styles.store');

    // University Wellnesses
    Route::get('/universities/{university}/wellnesses', [
        UniversityWellnessesController::class,
        'index',
    ])->name('universities.wellnesses.index');
    Route::post('/universities/{university}/wellnesses', [
        UniversityWellnessesController::class,
        'store',
    ])->name('universities.wellnesses.store');

    // University Students
    Route::get('/universities/{university}/students', [
        UniversityStudentsController::class,
        'index',
    ])->name('universities.students.index');
    Route::post('/universities/{university}/students', [
        UniversityStudentsController::class,
        'store',
    ])->name('universities.students.store');

    // University Rectorias
    Route::get('/universities/{university}/rectorias', [
        UniversityRectoriasController::class,
        'index',
    ])->name('universities.rectorias.index');
    Route::post('/universities/{university}/rectorias', [
        UniversityRectoriasController::class,
        'store',
    ])->name('universities.rectorias.store');

    // University Becas
    Route::get('/universities/{university}/becas', [
        UniversityBecasController::class,
        'index',
    ])->name('universities.becas.index');
    Route::post('/universities/{university}/becas', [
        UniversityBecasController::class,
        'store',
    ])->name('universities.becas.store');

    // University All Media
    Route::get('/universities/{university}/all-media', [
        UniversityAllMediaController::class,
        'index',
    ])->name('universities.all-media.index');
    Route::post('/universities/{university}/all-media', [
        UniversityAllMediaController::class,
        'store',
    ])->name('universities.all-media.store');

    Route::apiResource('all-media', MediaController::class);
});
