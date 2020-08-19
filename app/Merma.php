<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merma extends Model
{
    use SoftDeletes;
    protected $fillable = ['fecha', 'idProducto', 'cantidad'];
}
