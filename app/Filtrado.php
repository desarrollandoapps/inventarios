<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filtrado extends Model
{
    protected $fillable = [
        'valor',
        'referencia',
        'descripcion'
    ];
}
