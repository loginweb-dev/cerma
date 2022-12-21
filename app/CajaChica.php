<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CajaChica extends Model
{
    protected $fillable = ['glosa', 'monto', 'tipo_movimiento', 'cuenta_debe_id', 'cuenta_haber_id', 'user_id'];

    public function cuenta_debe(){
        return $this->belongsTo(\App\Models\PlansOfAccount::class, 'cuenta_debe_id');
    }
    public function cuenta_haber(){
        return $this->belongsTo(\App\Models\PlansOfAccount::class, 'cuenta_haber_id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    

   
}