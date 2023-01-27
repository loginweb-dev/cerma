<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Cuenta extends Model
{
    protected $fillable = ['nombre', 'detalles', 'plan_de_cuenta_id', 'codigo', 'monto', 'tipo_retencion'];

}
