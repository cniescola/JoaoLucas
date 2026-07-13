<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\EntradaEstoqueController;
use App\Http\Controllers\SaidaEstoqueController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\OsItemController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\DashboardController;

Route::middleware(['auth'])->group(function () {
    Route::resource('categorias', CategoriaController::class);

    Route::resource('fornecedores', FornecedorController::class)
        ->parameters(['fornecedores' => 'fornecedor']);

    Route::resource('produtos', ProdutoController::class);

    Route::get('/entradas', [EntradaEstoqueController::class, 'index'])->name('entradas.index');
    Route::get('/entradas/novo', [EntradaEstoqueController::class, 'create'])->name('entradas.create');
    Route::post('/entradas', [EntradaEstoqueController::class, 'store'])->name('entradas.store');

    Route::get('/saidas', [SaidaEstoqueController::class, 'index'])->name('saidas.index');
    Route::get('/saidas/novo', [SaidaEstoqueController::class, 'create'])->name('saidas.create');
    Route::post('/saidas', [SaidaEstoqueController::class, 'store'])->name('saidas.store');

    Route::resource('clientes', ClienteController::class);

    Route::post('/clientes/{cliente}/veiculos', [VeiculoController::class, 'store'])->name('veiculos.store');
    Route::delete('/veiculos/{veiculo}', [VeiculoController::class, 'destroy'])->name('veiculos.destroy');

    Route::resource('servicos', ServicoController::class);

    Route::get('/os/novo', [OrdemServicoController::class, 'create'])->name('os.create');

    Route::resource('os', OrdemServicoController::class)
        ->except(['create', 'edit'])
        ->parameters(['os' => 'os']);

    Route::post('/os/{os}/itens', [OsItemController::class, 'store'])->name('os.itens.store');
    Route::delete('/os-itens/{item}', [OsItemController::class, 'destroy'])->name('os.itens.destroy');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';