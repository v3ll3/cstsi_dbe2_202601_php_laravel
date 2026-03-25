<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    //
    public function index()
    {
        //echo "Listagem de produtos";
       $listaProdutos = Produto::all();
        //dd($listaProdutos);
        return view('produtos.index', ['produtos' => $listaProdutos]);
    }
}
