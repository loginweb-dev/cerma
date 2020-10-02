<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helper\HasManyRelation;
class Asiento extends Model
{
    use HasManyRelation;

    public function user(){
     return $this->belongsTo(\App\User::class);
    }

    public function items()
    {
        return $this->hasMany(Detalle::class);
    }
}
