<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GithubController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\ProfileController;
use App\Models\Lead;
use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('projects', ProjectController::class)->parameters([
        'projects' => 'project:slug'
    ]);

    Route::resource('types', TypeController::class)->parameters([
        'types' => 'type:slug'
    ]);

    Route::resource('technologies', TechnologyController::class)->parameters([
        'technologies' => 'technology:slug'
    ]);

    Route::get('/admin/project/trash', [ProjectController::class, 'trash_projects'])->name('trash');
    Route::put('/admin/trash/{project}/restore', [ProjectController::class, 'restore'])->name('restore');
    Route::delete('/admin/trash/{project}/destroy', [ProjectController::class, 'forceDelete'])->name('forceDelete');

    Route::get('fetch-repos', [GithubController::class, 'fetchRepos'])->name('github.fetch');

    /* Route::get('admin/leads', function () {

        $leads = Lead::all();

        return view('admin.leads.index', compact('leads'));
    })->name('leads'); */
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
