<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Modelos
use App\AporteAfiliado;

class RecibosController extends Controller
{
    public function recibo_aportacion(Request $request){
        if($request->id){
            return 1;
        }else{
            $recepcion = AporteAfiliado::with(['afiliado', 'aporte'])
                            ->where('afiliado_id', $request->afiliado_id)
                            ->where('periodo', $request->periodo)
                            ->get();
        }
        // dd($recepcion);
        return view('admin.recibos.aportacion', compact('recepcion'));
    }
}
