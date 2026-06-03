<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


#[Table('fornecedores')]
#[Fillable([
    "nome",
    "cnpj",
    "email",
    "estado_id",
    "telefone",
    "endereco"
])]
class Fornecedor extends Model
{
    use HasFactory;

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
