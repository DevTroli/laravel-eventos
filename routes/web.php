<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

// Rota da página inicial
Route::get('/', [AppController::class, 'index'])->name('home');

// Rotas de gerenciamento de ingressos
Route::get('/ingressos', [AppController::class, 'ingressos'])->name('ingressos');
Route::get('/ingressos/create', [AppController::class, 'create'])->name('ingressos-create');
Route::post('/ingressos/store', [AppController::class, 'store'])->name('ingressos-store');
Route::get('/ingressos/{id}/edit', [AppController::class, 'edit'])->name('ingressos-edit');
Route::post('/ingressos/{id}/update', [AppController::class, 'update'])->name('ingressos-update');
Route::post('/ingressos/{id}/destroy', [AppController::class, 'destroy'])->name('ingressos-destroy');

// Novas rotas institucionais
Route::get('/sobre', [AppController::class, 'sobre'])->name('sobre');
Route::get('/contato', [AppController::class, 'contato'])->name('contato');
Route::get('/login', [AppController::class, 'login'])->name('login');