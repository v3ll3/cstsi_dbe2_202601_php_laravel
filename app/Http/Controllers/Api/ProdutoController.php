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

            $produto = Produto::create($novoProduto);
            return new ProdutoResource($produto)
                    ->additional(["message"=>'Produto criado com sucesso!!'])
                    ->response()
                    ->setStatusCode(201,"Produto Criado.");
        } catch (ValidationException $error) {
            return response()->json(
                [
                    "data" => [
                        "error" => true,
                        "message" => $error->getMessage(),
                        "trace" => $error->getTrace()
                    ]
                ],
                $error->status
            );
            // throw $error;
        } catch (\Exception $error) {
            $httpStatus = 500;
            $message = "Não foi possível criar o Produto!!! Tente mais tarde.";
            $response = [
                "data" => [
                    "message" => $message,
                    "error" => true,
                ]
            ];
            if (env("APP_DEBUG"))
                $response['data'] = [
                    "message" => $error->getMessage(),
                    "trace" => $error->getTrace()
                ];
            return  response()->json($response, $httpStatus);
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
