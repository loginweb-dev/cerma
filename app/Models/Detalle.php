<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
  protected $fillable=['fecha','codigo','name','glosa','debe','haber','asiento_id'];
}
