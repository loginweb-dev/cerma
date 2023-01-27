<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class DineroAfiliado extends Model
{
    protected $table = 'dinero_afiliados';
    protected $fillable = ['afiliado_id', 'litros', 'precio_unitario', 'total_leche', 'total_cobro', 'total_a_pagar', 'observaciones', 'gestion'];

    public function afiliado(){
        return $this->belongsTo(Afiliado::class, 'afiliado_id');
    }

    public function asientos()
	{
		return $this->hasMany(\App\Models\Asiento::class);
	}

}
