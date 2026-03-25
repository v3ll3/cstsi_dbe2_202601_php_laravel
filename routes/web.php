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
