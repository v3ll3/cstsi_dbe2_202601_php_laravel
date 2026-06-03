<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    //

    public function produtos() {
        return $this->hasMany(Produto::class);
    }

  //$fornecedorModel->produtos
}
