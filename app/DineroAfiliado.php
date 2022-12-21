<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class DineroAfiliado extends Model
{
    protected $table = 'dinero_afiliados';
    protected $fillable = ['afiliado_id', 'litros', 'precio_unitario', 'total_leche', 'total_cobro', 'total_a_pagar', 'observaciones'];

    public function afiliado(){
        return $this->belongsTo(Afiliado::class, 'afiliado_id');
    }

}
