<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Pago extends Model
{
    protected $table = 'pagos';
    protected $fillable = ['pago_id', 'afiliado_id', 'monto', 'periodo', 'periodo_fin', 'observacion'];

    public function afiliado(){
        return $this->belongsTo(Afiliado::class, 'afiliado_id');
    }
    
    public function pago_option(){
        return $this->belongsTo(PagoOption::class, 'pago_id');
    }

   
}
