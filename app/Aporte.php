<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Aporte extends Model
{
    protected $fillable = ['cuenta_id', 'nombre', 'tipo', 'monto', 'descripcion'];
}
