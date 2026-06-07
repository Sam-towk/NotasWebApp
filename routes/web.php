<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotaController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [NotaController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::post('/notas', [NotaController::class, 'store'])->middleware(['auth'])->name('notas.store');
Route::get('/notas/{slug}', [NotaController::class, 'show'])->middleware(['auth'])->name('notas.show');
Route::delete('/notas/{slug}', [NotaController::class, 'destroy'])->middleware(['auth'])->name('notas.destroy');