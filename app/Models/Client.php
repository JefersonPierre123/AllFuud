<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'cpf',
        'nome',
        'sobrenome',
        'nascimento',
        'telefone',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
