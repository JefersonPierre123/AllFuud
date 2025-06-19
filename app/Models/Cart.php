<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'token',
        'items',
    ];

    // Automatically cast 'items' as array when using Eloquent
    protected $casts = [
        'items' => 'array',
    ];
}
