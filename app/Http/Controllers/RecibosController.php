<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Modelos
use App\RecepcionAfiliado;

class RecibosController extends Controller
{
    public function recibo_aportacion($id){
        $recepcion = RecepcionAfiliado::where('id', $id)->with(['afiliado', 'detalle.aporte'])->first();
        // dd($recepcion);
        return view('admin.recibos.aportacion', compact('recepcion'));
    }
}
