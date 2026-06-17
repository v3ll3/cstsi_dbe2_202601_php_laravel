<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Link extends Model
{
    /** @use HasFactory<\Database\Factories\LinkFactory> */
    use HasFactory;

    protected $table = 'medias';
    protected $fillable = [
        'type',
        'source'
    ];

    public function model():MorphTo
    {
        return $this->morphTo();
    }
}
