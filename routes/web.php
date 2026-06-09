<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $destaques = \App\Models\Ingresso::where('quantidade', '>', 0)->inRandomOrder()->limit(3)->get();
    return view('welcome', compact('destaques'));
});

// Rotas públicas (e-commerce)
Route::get('/ingressos', [AdminController::class, 'ingressosIndexPublic'])->name('ingressos.index');
Route::get('/ingresso/{id}', [AdminController::class, 'show'])->name('ingressos.show');
Route::get('/sobre', function() { return view('sobre'); })->name('sobre');
Route::get('/contato', function() { return view('contato'); })->name('contato');

// Carrinho
Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');
Route::post('/ingresso/{id}/carrinho', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
Route::post('/carrinho/remover/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');
Route::post('/carrinho/atualizar/{id}', [CarrinhoController::class, 'atualizar'])->name('carrinho.atualizar');
Route::get('/carrinho/checkout', [CarrinhoController::class, 'checkout'])->name('carrinho.checkout');
Route::post('/carrinho/confirmar', [CarrinhoController::class, 'confirmar'])->name('carrinho.confirmar');

// Pedidos do usuário (auth ou guest com email)
Route::get('/meus-pedidos', [CarrinhoController::class, 'meusPedidos'])->name('pedidos.index');
Route::get('/meus-pedidos/{id}', [CarrinhoController::class, 'show'])->name('pedidos.show');

// Admin (auth)
Route::get('/admin', [AdminController::class, 'dashboard'])->middleware('auth')->name('admin.dashboard');
Route::get('/admin/ingressos', [AdminController::class, 'ingressosIndex'])->middleware('auth')->name('admin.ingressos.index');
Route::get('/admin/ingressos/criar', [AdminController::class, 'ingressosCreate'])->middleware('auth')->name('admin.ingressos.create');
Route::post('/admin/ingressos', [AdminController::class, 'ingressosStore'])->middleware('auth')->name('admin.ingressos.store');
Route::get('/admin/ingressos/{id}/editar', [AdminController::class, 'ingressosEdit'])->middleware('auth')->name('admin.ingressos.edit');
Route::put('/admin/ingressos/{id}', [AdminController::class, 'ingressosUpdate'])->middleware('auth')->name('admin.ingressos.update');
Route::delete('/admin/ingressos/{id}', [AdminController::class, 'ingressosDestroy'])->middleware('auth')->name('admin.ingressos.destroy');
Route::get('/admin/pedidos', [AdminController::class, 'pedidosIndex'])->middleware('auth')->name('admin.pedidos.index');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
