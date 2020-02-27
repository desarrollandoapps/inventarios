<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subproducto extends Model
{
    protected $fillable = ['idPresentacion', 'idProducto', 'unidades'];
}
