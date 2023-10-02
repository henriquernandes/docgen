<?php

use App\Http\Controllers\EquipesController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\RotasController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {

    if (Auth::check()) {
        return redirect()->route('projetos.index');
    }

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware('auth')->group(function () {
    Route::get('dashboard', [RotasController::class, 'index'])->name('dashboard');
    Route::post('rotas', [RotasController::class, 'store'])->name('rotas.store');
    Route::put('rotas/{id}', [RotasController::class, 'update'])->name('rotas.update');
    Route::delete('rotas/{id}', [RotasController::class, 'destroy'])->name('rotas.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('projetos', [ProjectsController::class, 'index'])->name('projetos.index');
    Route::delete('projetos/{id}', [ProjectsController::class, 'destroy'])->name('projetos.destroy');
    Route::post('projetos', [ProjectsController::class, 'store'])->name('projetos.store');
    Route::put('projetos/{id}', [ProjectsController::class, 'update'])->name('projetos.update');

    Route::get('logs', [LogsController::class, 'index'])->name('logs.index');
});

require __DIR__ . '/auth.php';
