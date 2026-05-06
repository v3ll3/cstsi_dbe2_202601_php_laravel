<?php

use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuarioController;
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

    // Route::middleware('auth')->group(function() {
    Route::prefix('produto')->group(function () {
        Route::get('/',  'create');
        Route::post('/',  'store');
        Route::get('/{id}/edit',  'edit');
        Route::post('/{id}/update',  'update')->name('produto.update');
        Route::get('/{id}/delete',  'delete');
        Route::post('/{id}/delete',  'remove')->name('produto.remove');
    });
    // });
});


//Apenas para o middleware auth
// Route::get('login',function ()  {
//     echo "Realize o Login!!!";
// })->name('login');

Route::resource('fornecedores', FornecedorController::class)
    ->parameters(["fornecedores" => 'fornecedor']);

// Route::get('usuarios',[UsuarioController::class,'index'])->name('usuarios.index');
// Route::post('usuarios',[UsuarioController::class,'store'])->name('usuarios.store');
// Route::get('usuarios/create',[UsuarioController::class,'create'])->name('usuarios.create');
// Route::get('usuarios/{usuario}',[UsuarioController::class,'show'])->name('usuarios.show');
// Route::put('usuarios/{usuario}',[UsuarioController::class,'update'])->name('usuarios.update');
// Route::delete('usuarios/{usuario}',[UsuarioController::class,'delete'])->name('usuarios.destroy');
// Route::get('usuarios/{usuario}/edit',[UsuarioController::class,'edit'])->name('usuarios.edit');

Route::resource('usuarios', UsuarioController::class);
