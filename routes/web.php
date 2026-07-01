<?php

use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

//CONFIGURAÇÃO PARA REDIRECIONAR PARA O FRONTEND REACT
Route::any('/{any?}', function(){
    return view('index');
})->where('any', '^((?!api).)*$');
