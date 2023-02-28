<?php

use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\ProjectController as ProjectController;
use App\Http\Controllers\Guest\ProjectController as GuestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [GuestController::class, "index"])->name("welcolme");


/* Route::get('/', [ProjectController::class, "index"])->name("welcolme");
Route::delete('/', [ProjectController::class, "index"])->name("welcolme"); */



Route::middleware(['auth', 'verified'])
->name('admin.')
->prefix('admin')
->group(function () {
    Route::get('/', [DashBoardController::class, 'index'])->name('dashboard');
    Route::get('projects/trashed', [ProjectController::class, "trashed"])->name("projects.trashed");
    Route::get('projects/{project}/restore', [ProjectController::class, "restore"])->name("projects.restore");
    Route::delete('projects/{project}/force-delete', [ProjectController::class, "forceDelete"])->name("projects.force-delete");
    Route::post('admin/restore-all', [ProjectController::class, 'restoreAll'])->name('restore-all');
    Route::resource('/projects', ProjectController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
