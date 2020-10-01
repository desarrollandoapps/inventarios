<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class XYZ extends Model
{
    protected $fillable = [
        'referencia',
        'descripcion',
        'media',
        'desvStd',
        'coefVar',
        'tipo'
    ];
}
