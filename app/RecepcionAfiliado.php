<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class RecepcionAfiliado extends Model
{
    protected $table = 'recepcion_afiliado';
    protected $fillable = ['afiliado_id', 'acopio', 'total_litros', 'precio_unidad', 'observaciones', 'periodo', 'estado'];

    public function afiliado(){
        return $this->belongsTo('App\Afiliado', 'afiliado_id');
    }
}
