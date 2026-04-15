<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ola', [HomeController::class, 'index']);
Route::get('/ola/{name}', [HomeController::class, 'index']);
Route::get('/users', [HomeController::class, 'list']);



Route::prefix('produtos')->group(function () {
    Route::get('/', [ProdutoController::class, 'index']);
    Route::get('/{id}', [ProdutoController::class, 'show']);
});

Route::prefix('produto')->group(function () {
    Route::get('/', [ProdutoController::class, 'create']);
    Route::post('/', [ProdutoController::class, 'store']);
    Route::get('/{id}/edit', [ProdutoController::class, 'edit']);
    Route::post('/{id}/update', [ProdutoController::class, 'update'])->name('produto.update');
    Route::get('/{id}/delete', [ProdutoController::class, 'delete']);
    Route::post('/{id}/delete', [ProdutoController::class, 'remove'])->name('produto.remove');
});
