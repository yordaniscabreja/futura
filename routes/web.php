<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\BecaController;
use App\Http\Controllers\BondController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AcademyController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EconomyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ModalityController;
use App\Http\Controllers\PrestigeController;
use App\Http\Controllers\RectoriaController;
use App\Http\Controllers\WellnessController;
use App\Http\Controllers\ConvenioController;
use App\Http\Controllers\AgreementController;
use App\Http\Controllers\BasicCoreController;
use App\Http\Controllers\LifeStyleController;
use App\Http\Controllers\MediaTypeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RequerimentController;
use App\Http\Controllers\AcademicLevelController;
use App\Http\Controllers\KnowledgeAreaController;
use App\Http\Controllers\EducationLevelController;
use App\Http\Controllers\AcademicProgramController;
use App\Http\Controllers\InternalizationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('countries', CountryController::class);
        Route::resource('cities', CityController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('academic-levels', AcademicLevelController::class);
        Route::resource('academic-programs', AcademicProgramController::class);
        Route::resource('academies', AcademyController::class);
        Route::resource('agreements', AgreementController::class);
        Route::resource('basic-cores', BasicCoreController::class);
        Route::resource('benefits', BenefitController::class);
        Route::resource('comments', CommentController::class);
        Route::resource('internalizations', InternalizationController::class);
        Route::resource('education-levels', EducationLevelController::class);
        Route::resource('knowledge-areas', KnowledgeAreaController::class);
        Route::resource('life-styles', LifeStyleController::class);
        Route::resource('media-types', MediaTypeController::class);
        Route::resource('modalities', ModalityController::class);
        Route::resource('prestiges', PrestigeController::class);
        Route::resource('campuses', CampusController::class);
        Route::resource('economies', EconomyController::class);
        Route::resource('rectorias', RectoriaController::class);
        Route::resource('requeriments', RequerimentController::class);
        Route::resource('students', StudentController::class);
        Route::resource('users', UserController::class);
        Route::resource('wellnesses', WellnessController::class);
        Route::resource('zones', ZoneController::class);
        Route::get('all-media', [MediaController::class, 'index'])->name(
            'all-media.index'
        );
        Route::post('all-media', [MediaController::class, 'store'])->name(
            'all-media.store'
        );
        Route::get('all-media/create', [
            MediaController::class,
            'create',
        ])->name('all-media.create');
        Route::get('all-media/{media}', [MediaController::class, 'show'])->name(
            'all-media.show'
        );
        Route::get('all-media/{media}/edit', [
            MediaController::class,
            'edit',
        ])->name('all-media.edit');
        Route::put('all-media/{media}', [
            MediaController::class,
            'update',
        ])->name('all-media.update');
        Route::delete('all-media/{media}', [
            MediaController::class,
            'destroy',
        ])->name('all-media.destroy');

        Route::resource('becas', BecaController::class);
        Route::resource('bonds', BondController::class);
        Route::resource('convenios', ConvenioController::class);
        Route::resource('universities', UniversityController::class);
    });
