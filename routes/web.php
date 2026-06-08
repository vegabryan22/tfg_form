<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EncuestaController;
use App\Http\Controllers\EntrevistaController;
use App\Http\Controllers\PruebaController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('encuesta.show'));

// Instrumento 1 – Encuesta Likert (Estudiantes)
Route::get('/encuesta', [EncuestaController::class, 'show'])->name('encuesta.show');
Route::post('/encuesta', [EncuestaController::class, 'store'])->name('encuesta.store');
Route::get('/encuesta/gracias', [EncuestaController::class, 'gracias'])->name('encuesta.gracias');

// Instrumento 2 – Entrevista Semiestructurada (Docentes)
Route::get('/entrevista', [EntrevistaController::class, 'show'])->name('entrevista.show');
Route::post('/entrevista', [EntrevistaController::class, 'store'])->name('entrevista.store');
Route::get('/entrevista/gracias', [EntrevistaController::class, 'gracias'])->name('entrevista.gracias');

// Instrumento 3 – Prueba Diagnóstica
Route::get('/prueba', [PruebaController::class, 'show'])->name('prueba.show');
Route::post('/prueba', [PruebaController::class, 'store'])->name('prueba.store');
Route::get('/prueba/gracias', [PruebaController::class, 'gracias'])->name('prueba.gracias');

// Panel de administración
Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.authenticate');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/encuestas', [AdminController::class, 'encuestas'])->name('encuestas');
    Route::get('/encuestas/export', [AdminController::class, 'exportEncuestas'])->name('encuestas.export');
    Route::get('/encuestas/{encuesta}', [AdminController::class, 'verEncuesta'])->name('encuesta.show');

    Route::get('/entrevistas', [AdminController::class, 'entrevistas'])->name('entrevistas');
    Route::get('/entrevistas/export', [AdminController::class, 'exportEntrevistas'])->name('entrevistas.export');
    Route::get('/entrevistas/{entrevista}', [AdminController::class, 'verEntrevista'])->name('entrevista.show');

    Route::get('/pruebas', [AdminController::class, 'pruebas'])->name('pruebas');
    Route::get('/pruebas/export', [AdminController::class, 'exportPruebas'])->name('pruebas.export');
    Route::get('/pruebas/{prueba}', [AdminController::class, 'verPrueba'])->name('prueba.show');
});
