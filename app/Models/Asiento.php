<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helper\HasManyRelation;
class Asiento extends Model
{
    use HasManyRelation;

    protected $fillable=['user_id','ufu','tipo_cambio','glosa','total_haber','total_debe','comprobante', 'aporte_afiliado_id'];

    public function user(){
     return $this->belongsTo(\App\User::class);
    }

    public function items()
    {
        return $this->hasMany(Detalle::class);
    }
}
