<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable = ['nit', 'nombre', 'telefono', 'direccion', 'formaPago', 'descuento', 'tiempoEntrega', 'devoluciones'];
}
