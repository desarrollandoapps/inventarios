<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleTemporal extends Model
{
    protected $fillable = [
        'cantidad',
        'valor',
        'idVenta',
        'idProducto'
    ];
}
