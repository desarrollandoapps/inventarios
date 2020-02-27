<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Despacho extends Model
{
    protected $fillable = ['fecha', 'idCliente'];
}
