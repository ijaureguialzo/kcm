<?php

use App\Http\Controllers\CompilationController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RepositoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    Auth::routes([
        'reset' => config('auth.password_reset_enabled'),
        'verify' => config('auth.email_verification_enabled'),
    ]);

    $auth_middlewares = config('auth.email_verification_enabled') ? ['auth', 'verified'] : ['auth'];
    Route::middleware($auth_middlewares)->group(function () {

        Route::get('/', function () {
            $user = Auth::user();
            if ($user->hasRole('editor')) {
                return redirect(route('editor.index'));
            }

            return view('welcome');
        })->name('home');

        Route::resource('users', UserController::class)->except(['show']);
        Route::resource('roles', RoleController::class)->except(['show']);
        Route::resource('permissions', PermissionController::class)->except(['show']);

        Route::resource('feeds', FeedController::class)->except(['show']);

        Route::get('/editor', [EditorController::class, 'index'])
            ->name('editor.index');

        Route::resource('repositories', RepositoryController::class)->except(['show']);
        Route::resource('compilations', CompilationController::class)->except(['show']);
        Route::resource('posts', PostController::class)->except(['show']);

        Route::post('/compilations/{compilation}/selection_add', [CompilationController::class, 'selection_add'])
            ->name('compilations.selection.add');
        Route::post('/compilations/{compilation}/selection_remove', [CompilationController::class, 'selection_remove'])
            ->name('compilations.selection.remove');
        Route::post('/compilations/selection_clear', [CompilationController::class, 'selection_clear'])
            ->name('compilations.selection.clear');
        Route::post('/compilations/{compilation}/publish', [CompilationController::class, 'publish'])
            ->name('compilations.publish');

        Route::post('/editor/{item}/mark_item_read', [EditorController::class, 'mark_item_read'])
            ->name('editor.mark_item_read');
        Route::post('/editor/{item}/compile_post', [EditorController::class, 'compile_post'])
            ->name('editor.compile_post');
        Route::post('/editor/select_feed', [EditorController::class, 'select_feed'])
            ->name('editor.select_feed');

        Route::get('/repositories/public', [RepositoryController::class, 'public'])
            ->name('repositories.public');
        Route::post('/repositories/{repository}/{user}/subscribe', [RepositoryController::class, 'subscribe'])
            ->name('repositories.subscribe');
        Route::post('/repositories/{repository}/{user}/unsubscribe', [RepositoryController::class, 'unsubscribe'])
            ->name('repositories.unsubscribe');

    });
});
