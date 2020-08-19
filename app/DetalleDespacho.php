<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetalleDespacho extends Model
{
    use SoftDeletes;
    protected $fillable = ['idDespcaho', 'idProducto', 'cantidad'];
}
