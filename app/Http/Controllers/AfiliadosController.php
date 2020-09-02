<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Afiliado;

class AfiliadosController extends Controller
{
    public function get_afiliado($dato){
        return Afiliado::whereRaw("(nombre_completo like '%$dato%' or ci like '%$dato%' or rau like '%$dato%')")->get();
    }
}
