<?php

use App\Http\Controllers\AppController;
// importa a controller
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'index'])->name('home');

Route::get('/eventos', [AppController::class, 'eventos'])->name('eventos');

Route::get('/eventos/create', [AppController::class, 'create'])->name('eventos-create');
Route::post('/eventos/store', [AppController::class, 'store'])->name('eventos-store');

Route::get('/eventos/{id}/edit', [AppController::class, 'edit'])->name('eventos-edit');
Route::post('/eventos/{id}/update', [AppController::class, 'update'])->name('eventos-update');

Route::post('/eventos/{id}/destroy', [AppController::class, 'destroy'])->name('eventos-destroy');
