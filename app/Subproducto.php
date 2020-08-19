<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subproducto extends Model
{
    use SoftDeletes;
    protected $fillable = ['idPresentacion', 'idProducto', 'unidades'];
}
