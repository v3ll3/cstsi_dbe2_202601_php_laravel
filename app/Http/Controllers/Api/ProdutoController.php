<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdutoStoreRequest;
use App\Http\Resources\ProdutoResource;
use App\Http\Resources\ProdutoResourceCollection;
use App\Http\Resources\ProdutoStoredResource;
use App\Models\Produto;
use Illuminate\Http\Request;

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
    public function store(ProdutoStoreRequest $request)
    {
        try {
            return new ProdutoStoredResource(Produto::create($request->validated()));
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
