<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class AporteAfiliado extends Model
{
    protected $table = 'aporte_afiliado';
    protected $fillable = ['aporte_id', 'afiliado_id', 'monto', 'periodo', 'observacion'];

    public function afiliado(){
        return $this->belongsTo(Afiliado::class, 'afiliado_id');
    }

    public function aporte(){
        return $this->belongsTo(Aporte::class, 'aporte_id');
    }
}
