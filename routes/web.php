<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'home'])->name('home');
Route::post('/generate', [MainController::class, 'generateExercises'])->name('generate');
Route::get('/print-exercises', [MainController::class, 'printExercises'])->name('printExercises');
Route::get('/export-exercises', [MainController::class, 'exportExercise'])->name('exportExercise');



