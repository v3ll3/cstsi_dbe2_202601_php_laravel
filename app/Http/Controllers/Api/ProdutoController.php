<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProdutoResource;
use App\Http\Resources\ProdutoResourceCollection;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return response()->json(Produto::all());
        return new ProdutoResourceCollection(Produto::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        //  return response()->json($produto);
        return new ProdutoResource($produto);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $request->validate([
                'nome' => "required",
                'descricao' => "required",
                'qtd_estoque' => "required | integer",
                'preco' => "required | numeric",
                'importado' => "nullable"

            ]);
            $novoProduto = $request->all();
            $novoProduto['importado'] = $request->has('importado');

            return response()->json([
                "data" => [
                    'produto' => Produto::create($novoProduto),
                    'msg' => 'Produto criado !!!'
                ]
            ], 201);
        } catch (\Exception $error) {
            $httpStatus = 500;
            if ($error instanceof ValidationException) $httpStatus = 422;
            return response()->json(
                [
                    "data" => [
                        "error" => true,
                        "message" => $error->getMessage()
                    ]
                ],
                $httpStatus
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        //
    }
}
