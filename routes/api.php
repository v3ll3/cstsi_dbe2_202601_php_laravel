<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LoginTokensController;
use App\Http\Controllers\Api\FornecedorController;
use App\Http\Controllers\Api\ProdutoController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::apiResource('produtos', ProdutoController::class);

    Route::apiResource('fornecedores', FornecedorController::class)
        ->parameters(["fornecedores" => 'fornecedor']);

    Route::apiResource('users', UserController::class)
        ->only(['store']);

    Route::middleware('web')->group(function () {
        Route::apiResource('users', UserController::class)
            ->only(['index', 'show', 'delete', 'update'])->middleware('auth:sanctum');
        Route::post('login', [LoginController::class, 'login']);
    });

    Route::prefix('token')->group(function ()  {
        Route::post('login',[LoginTokensController::class,'login']);
    });
});
