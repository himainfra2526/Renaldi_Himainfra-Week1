<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoalController;

Route::get('/soal',[SoalController::class, 'index'])->name('soal.index'); 
Route::post('/soal',[SoalController::class,'store'])->name('soal.store');
Route::delete('/soal/{id}',[SoalController::class,'destroy'])->name('soal.destroy');
Route::get('/soal/{id}/edit',[SoalController::class,'edit'])->name('soal.edit');
Route::put('/soal/{id}',[SoalController::class,'update'])->name('soal.update');

Route::get('/api/soal',[SoalController::class, 'api']);
Route::get('/viewer', function () {
    return view('viewer');
});