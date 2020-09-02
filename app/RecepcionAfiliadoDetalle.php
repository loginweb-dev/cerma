<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class RecepcionAfiliadoDetalle extends Model
{
    protected $table = 'recepcion_afiliado_detalle';
    protected $fillable = ['recepcion_afiliado_id', 'aporte_id', 'monto'];

    public function aporte(){
        return $this->belongsTo('App\Aporte', 'aporte_id');
    }
}
