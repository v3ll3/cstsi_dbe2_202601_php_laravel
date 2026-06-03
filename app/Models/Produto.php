<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// #[Fillable(['nome', 'descricao', 'qtd_estoque', 'preco', 'importado'])]

class Produto extends Model
{
    /** @use HasFactory<\Database\Factories\ProdutoFactory> */
    use HasFactory;

    // protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'descricao',
        'qtd_estoque',
        'preco',
        'importado'
    ];

    public function fornecedor(){
        return $this->belongsTo(Fornecedor::class);
    }

}
