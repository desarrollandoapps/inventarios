<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleTemporal extends Model
{
    protected $fillable = [
        'idVenta',
        'idProducto',
        'enero',
        'febrero',
        'marzo',
        'abril',
        'mayo',
        'junio',
        'julio',
        'agosto',
        'septiembre',
        'octubre',
        'noviembre',
        'diciembre',
        'total'
    ];
}
