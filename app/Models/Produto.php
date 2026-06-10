<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// #[Fillable(['nome', 'descricao', 'qtd_estoque', 'preco', 'importado'])]

class Produto extends Model
{
    /** @use HasFactory<\Database\Factories\ProdutoFactory> */
    use HasFactory,  \Znck\Eloquent\Traits\BelongsToThrough;

    // protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'descricao',
        'qtd_estoque',
        'preco',
        'importado',
        'fornecedor_id'
    ];

    public function fornecedor(){
        // return $this->belongsTo(
        //         Fornecedor::class,
        //         'fornecedor_id',
        //         'id_fornecedor'
        //     );
        return $this->belongsTo(Fornecedor::class);
    }

     public function regiao(){
        return $this->belongsToThrough(
            Regiao::class,
            [
                Estado::class,
                Fornecedor::class
            ],
            foreignKeyLookup:[
                Regiao::class=>'regiao_id',
                Fornecedor::class=>'fornecedor_id'
            ]
        );
    }


    public function promocoes()
    {
        return $this->belongsToMany(Promocao::class)
                    ->withPivot('desconto')
                    ->withTimestamps();

    }

}
