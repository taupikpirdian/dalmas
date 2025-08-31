<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\PersonilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\SprintController;
use App\Http\Controllers\admin\AboutUsController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');

// Public routes
Route::get('/sprint-public', [SprintController::class, 'datatablePublic'])->name('public.sprint.index');
Route::get('/penugasan/upload', [SprintController::class, 'penugasanUpload'])->name('public.sprint.upload');
Route::post('/penugasan/upload', [SprintController::class, 'aksesUpload'])->name('public.sprint.upload-akses');
Route::get('/penugasan/upload/page/{id}', [SprintController::class, 'uploadPage'])->name('public.sprint.upload-page');
Route::post('/penugasan/upload/page/{id}', [SprintController::class, 'uploadPageStore'])->name('public.sprint.upload-page-store');

Auth::routes();
Route::middleware(['auth'])->group(
    function () {
        Route::name('dashboard.')->prefix('dashboard')->group(function () {
            Route::controller(DashboardController::class)->group(function () {
                Route::get('/', 'index')->name('index');
            });
        });

        // users
        Route::name('dashboard.')->prefix('dashboard')->group(function () {
            Route::controller(UsersController::class)->group(function () {
                Route::get('/users', 'index')->name('users.index');
                Route::get('/users/create', 'create')->name('users.create');
                Route::post('/users', 'store')->name('users.store');
                Route::get('/users/{id}/edit', 'edit')->name('users.edit');
                Route::put('/users/{id}', 'update')->name('users.update');
                Route::delete('/users/{id}', 'destroy')->name('users.destroy');
                Route::get('/users/polsek/{polres_id}', 'getPolsek')->name('users.polsek');
                Route::get('/users/{id}', 'show')->name('users.show');
            });
        });

        // roles
        Route::name('dashboard.')->prefix('dashboard')->group(function () {
            Route::controller(RolesController::class)->group(function () {
                Route::get('/roles', 'index')->name('roles.index');
            });
        });

        // perkaras
        Route::name('dashboard.')->prefix('dashboard')->group(function () {
            Route::name('sprint.')->prefix('sprint')->group(function () {
                Route::controller(SprintController::class)->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/datatable', 'datatable')->name('datatable');
                    Route::get('/{id}/edit', 'edit')->name('edit');
                    Route::put('/{id}', 'update')->name('update');
                    Route::delete('/{id}', 'destroy')->name('destroy');
                    Route::get('/{id}', 'show')->name('show');
                });
            });

            Route::name('personil.')->prefix('personil')->group(function () {
                Route::controller(PersonilController::class)->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/datatable', 'datatable')->name('datatable');
                    Route::get('/{id}/edit', 'edit')->name('edit');
                    Route::put('/{id}', 'update')->name('update');
                    Route::delete('/{id}', 'destroy')->name('destroy');
                    Route::get('/{id}', 'show')->name('show');
                });
            });
        });

        // about-us
        Route::name('dashboard.')->prefix('dashboard')->group(function () {
            Route::controller(AboutUsController::class)->group(function () {
                Route::get('/about-us', 'index')->name('about-us.index');
                Route::get('/about-us/create', 'create')->name('about-us.create');
                Route::post('/about-us', 'store')->name('about-us.store');
                Route::get('/about-us/{id}/edit', 'edit')->name('about-us.edit');
                Route::put('/about-us/{id}', 'update')->name('about-us.update');
                Route::delete('/about-us/{id}', 'destroy')->name('about-us.destroy');
                Route::get('/about-us/{id}', 'show')->name('about-us.show');
            });
        });
    }
);

Route::get('file/{id}/{name}', function ($id, $name) {
    $path = storage_path('app/public/sprints/' . $id . '/' . $name);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});
