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
       $listaProdutos = Produto::all()->reverse();
        //dd($listaProdutos);
        return view('produtos.index', ['produtos' => $listaProdutos]);
    }

    public function show($id)
    {
        // $produto = Produto::findOrFail($id);//Gera exceção e a página de 404
        $produto = Produto::find($id);
        return view('produtos.show', ['produto' => $produto]);
    }

    public function store(Request $request)
    {
        $novoProduto = $request->all();
        $novoProduto['importado'] = $request->has('importado');

        if(Produto::create($novoProduto)){
            return redirect('/produtos');
        }
       dd("Erro ao criar produto!");
    }

    public function create()
    {
        return view('produtos.create');
    }


    public function update(Request $request, $id)
    {
        $novoProduto = $request->all();

        $novoProduto['importado'] = $request->has('importado');

        // dd($novoProduto);
        if(Produto::findOrFail($id)->update($novoProduto)){
            return redirect('/produtos');
        }
       dd("Erro ao criar atualizar!");
    }

    public function edit($id)
    {

        $produto = Produto::findOrFail($id);
        // dd($produto);
        return view('produtos.edit', ['produto' => $produto]);
    }

     public function delete($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produtos.delete', compact('produto'));
    }

    public function remove($id)
    {
        if(Produto::destroy($id)){
            return redirect('/produtos');
        }
       dd("Erro ao excluir produto!");
    }
}
