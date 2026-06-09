<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $destaques = \App\Models\Ingresso::where('quantidade', '>', 0)->inRandomOrder()->limit(3)->get();
    return view('welcome', compact('destaques'));
});

Route::get('/ingressos', [AdminController::class, 'ingressosIndexPublic'])->name('ingressos.index');
Route::get('/ingresso/{id}', [AdminController::class, 'show'])->name('ingressos.show');
Route::get('/sobre', function () { return view('sobre'); })->name('sobre');
Route::get('/contato', function () { return view('contato'); })->name('contato');

Route::get('/carrinho', [CarrinhoController::class, 'index'])->name('carrinho.index');

Route::middleware('auth')->group(function () {
    Route::post('/ingresso/{id}/carrinho', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
    Route::post('/carrinho/remover/{id}', [CarrinhoController::class, 'remover'])->name('carrinho.remover');
    Route::post('/carrinho/atualizar/{id}', [CarrinhoController::class, 'atualizar'])->name('carrinho.atualizar');
    Route::get('/carrinho/checkout', [CarrinhoController::class, 'checkout'])->name('carrinho.checkout');
    Route::post('/carrinho/confirmar', [CarrinhoController::class, 'confirmar'])->name('carrinho.confirmar');

    Route::get('/meus-pedidos', [CarrinhoController::class, 'meusPedidos'])->name('pedidos.index');
    Route::get('/meus-pedidos/{id}', [CarrinhoController::class, 'show'])->name('pedidos.show');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/ingressos', [AdminController::class, 'ingressosIndex'])->name('admin.ingressos.index');
    Route::get('/ingressos/criar', [AdminController::class, 'ingressosCreate'])->name('admin.ingressos.create');
    Route::post('/ingressos', [AdminController::class, 'ingressosStore'])->name('admin.ingressos.store');
    Route::get('/ingressos/{id}/editar', [AdminController::class, 'ingressosEdit'])->name('admin.ingressos.edit');
    Route::put('/ingressos/{id}', [AdminController::class, 'ingressosUpdate'])->name('admin.ingressos.update');
    Route::delete('/ingressos/{id}', [AdminController::class, 'ingressosDestroy'])->name('admin.ingressos.destroy');
    Route::get('/pedidos', [AdminController::class, 'pedidosIndex'])->name('admin.pedidos.index');
});

Route::get('/dashboard', function () {
    if (auth()->user()?->is_admin) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('pedidos.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
