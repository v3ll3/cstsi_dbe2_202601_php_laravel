<?php

namespace App\Repositories;

use App\Models\Produto;
use App\Services\ProdutoUploadService;

class ProdutoRepository
{
    public static function store(array $produtoData): Produto
    {
        if (!isset($produtoData['imagem']))
            return Produto::create($produtoData);

        $produtoData['imagem'] = ProdutoUploadService::handleUploadFile($produtoData['imagem']);
        if (!$produtoData['imagem'])
            return Produto::create($produtoData);

        $novoProduto = Produto::create($produtoData);
        $novoProduto->links()->create([
            'source' => $produtoData['imagem']
        ]);
        return $novoProduto->load('links');
    }
}
