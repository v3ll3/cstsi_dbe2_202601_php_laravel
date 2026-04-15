<?php

use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\Api\FornecedorController as ApiFornecedorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ola', [HomeController::class, 'index']);
Route::get('/ola/{name}', [HomeController::class, 'index']);
Route::get('/users', [HomeController::class, 'list']);


Route::controller(ProdutoController::class)->group(function () {
    Route::prefix('produtos')->group(function () {
        Route::get('/',  'index');
        Route::get('/{produto}',  'show');
    });

    Route::middleware('auth')->group(function() {
        Route::prefix('produto')->group(function () {
                Route::get('/',  'create');
                Route::post('/',  'store');
                Route::get('/{id}/edit',  'edit');
                Route::post('/{id}/update',  'update')->name('produto.update');
                Route::get('/{id}/delete',  'delete');
                Route::post('/{id}/delete',  'remove')->name('produto.remove');
            });
    });
});
