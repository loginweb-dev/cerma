<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

// Exportación a Excel
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RecepcionImport;

// Modelos
use App\RecepcionAfiliado;
use App\RecepcionAfiliadoDetalle;
use App\Aporte;

class ReporteController extends Controller
{
    public function importar_recepcion(){
        return view('admin.reportes.recepciones');
    }

    public function importar_recepcion_list(Request $request){
        $recepciones = DB::table('recepcion_afiliado as ra')
                            ->join('afiliados as a', 'a.id', 'ra.afiliado_id')
                            ->selectRaw('a.id, ra.afiliado_id, a.nombre_completo, a.rau, SUM(ra.total_litros) as total_litros, ra.precio_unidad')
                            ->where('estado', 1)
                            ->whereMonth('ra.periodo', $request->mes)
                            ->whereYear('ra.periodo', $request->anio)
                            ->groupBy('a.id')
                            ->get();
        return view('admin.reportes.recepciones_list', compact('recepciones'));
    }

    public function importar_recepcion_datos(Request $request){
        try {
            DB::table('recepcion_afiliado')->where('estado', 0)->delete();
            $base_name = Str::random(20);
            $filename = $base_name.'.'.$request->file('file')->getClientOriginalExtension();
            $path = $request->file('file')->storeAs('public/import_excel/'.date('F').date('Y'), $filename);
            Excel::import(new RecepcionImport, $path);
            return response()->json(['data' => 'success']);
        } catch (\Exception $e) {
            return response()->json(['data' => 'error']);
        }
    }

    public function importar_recepcion_datos_view(){
        $mensualidad = Aporte::find(1)->monto;
        $aporte_leche = Aporte::find(2)->monto;
        $recepciones = DB::table('recepcion_afiliado as ra')
                            ->join('afiliados as a', 'a.id', 'ra.afiliado_id')
                            ->selectRaw('a.id, ra.afiliado_id, a.nombre_completo, a.rau, SUM(ra.total_litros) as total_litros, ra.precio_unidad')
                            ->where('estado', 0)
                            ->groupBy('a.id')
                            ->get();
        return view('admin.reportes.recepciones_view', compact('recepciones', 'mensualidad', 'aporte_leche'));
    }

    public function importar_recepcion_datos_store(Request $request){
        DB::beginTransaction();
        try {
            for ($i=0; $i < count($request->id); $i++) { 
                // Registrar ambos aportes en el detalle de recepción
                RecepcionAfiliadoDetalle::create([
                    'recepcion_afiliado_id' => $request->id[$i],
                    'aporte_id' => 1,
                    'monto' => $request->mensualidad[$i]
                ]);
                RecepcionAfiliadoDetalle::create([
                    'recepcion_afiliado_id' => $request->id[$i],
                    'aporte_id' => 2,
                    'monto' => $request->aporte_leche[$i]
                ]);
                
                // Actualizar datos de recepción
                RecepcionAfiliado::where('afiliado_id', $request->afiliado_id[$i])->update([
                    'periodo' => $request->periodo,
                    'estado' => 1
                ]);
            }
            
            DB::commit();
            return redirect('admin/importar/recepciones')->with(['message' => 'Recepción registrada exitosamenete.', 'alert-type' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('admin/importar/recepciones')->with(['message' => 'Ocurrió un error inesperado.', 'alert-type' => 'error']);
        }
    }
}
