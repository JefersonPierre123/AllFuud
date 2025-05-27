<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    use HasFactory;

    protected $table = 'establishments';

    protected $fillable = [
        'imagem',
        'cnpj',
        'nome_franquia',
        'nome_unidade',
        'descricao',
        'categoria',
        'classificacao',
        'telefone',
        'email_contato',
        'cep',
        'estado',
        'cidade',
        'bairro',
        'endereco',
        'numero',
        'complemento',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

