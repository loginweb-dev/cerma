<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Modelos
use App\AporteAfiliado;

class RecibosController extends Controller
{
    public function recibo_aportacion(Request $request){
        if($request->id){
            $recepcion = AporteAfiliado::with(['afiliado', 'aporte'])
                            ->where('id', $request->id)
                            ->get();
        }else{
            $recepcion = AporteAfiliado::with(['afiliado', 'aporte'])
                            ->where('afiliado_id', $request->afiliado_id)
                            ->where('periodo', $request->periodo)
                            ->get();
        }
        return view('admin.recibos.aportacion', compact('recepcion'));
    }
}
