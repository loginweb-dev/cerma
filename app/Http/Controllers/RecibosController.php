<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Modelos
use App\AporteAfiliado;
use App\Pago;
use App\DineroAfiliado;

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
                            ->where('deleted_at', NULL)
                            ->get();
        }
        return view('admin.recibos.aportacion', compact('recepcion'));
    }

    public function recibo_pago(Request $request){
        // if($request->id){
            $recepcion = Pago::with(['afiliado', 'pago_option'])
                            ->where('id', $request->id)
                            ->get();
        // }else{
        //     $recepcion = AporteAfiliado::with(['afiliado', 'aporte'])
        //                     ->where('afiliado_id', $request->afiliado_id)
        //                     ->where('periodo', $request->periodo)
        //                     ->where('deleted_at', NULL)
        //                     ->get();
        // }
        // return $recepcion;
        return view('admin.recibos.pago', compact('recepcion'));
    }

    public function recibo_dinero_afiliado(Request $request){
        $recepcion = DineroAfiliado::with(['afiliado'])
                                    ->where('id', $request->id)
                                    ->get();
        return view('admin.recibos.dineroafiliado', compact('recepcion'));
    }
}
