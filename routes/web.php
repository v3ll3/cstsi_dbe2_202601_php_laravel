<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ola', [HomeController::class,'index']);
Route::get('/ola/{name}', [HomeController::class,'index']);
Route::get('/users', [HomeController::class,'list']);

Route::get('/produtos', [ProdutoController::class,'index']);
Route::get('/produtos/{id}', [ProdutoController::class,'show']);
Route::get('/produto', [ProdutoController::class,'create']);
Route::post('/produto', [ProdutoController::class,'store']);

Route::get('/produto/{id}/edit', [ProdutoController::class,'edit']);
Route::post('/produto/{id}/update', [ProdutoController::class,'update'])->name('produto.update');

Route::get('/produto/{id}/delete',[ProdutoController::class,'delete']);
