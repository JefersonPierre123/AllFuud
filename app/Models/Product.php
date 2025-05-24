<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'imagem',
        'nome',
        'descricao',
        'nome_unidade',
        'valor',
        'establishment_id',
    ];

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }
}

