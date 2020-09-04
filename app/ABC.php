<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ABC extends Model
{
    protected $fillable = [
        'valor',
        'referencia',
        'descripcion',
        'tipo'
    ];
}
