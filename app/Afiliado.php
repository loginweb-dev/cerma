<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Afiliado extends Model
{
    protected $fillable = ['nombre_completo', 'ci', 'rau', 'movil', 'direccion', 'localidad', 'fecha_afiliacion', 'fecha_ultimo_pago', 'foto'];
}
