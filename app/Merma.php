<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merma extends Model
{
    protected $fillable = ['fecha', 'idProducto', 'cantidad'];
}
