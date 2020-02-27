<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nit', 'nombre', 'telefono', 'direccion', 'formaPago'];
}
