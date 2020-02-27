<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleDespacho extends Model
{
    protected $fillable = ['idDespcaho', 'idProducto', 'cantidad'];
}
