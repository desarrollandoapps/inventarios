<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected $fillable = [
        'cantidad',
        'valor',
        'idVenta',
        'idProducto'
    ];
}
