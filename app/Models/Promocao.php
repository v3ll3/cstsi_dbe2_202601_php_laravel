<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocao extends Model
{
    use HasFactory;
    protected $table = "promocoes";
    protected $fillable = [
        'nome',
        'inicio',
        'fim',
        'desconto'
    ];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class)
                    ->withPivot('desconto')
                    ->withTimestamps();
    }
}
