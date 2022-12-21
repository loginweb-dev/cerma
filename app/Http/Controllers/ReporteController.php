<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Http\Controllers\AporteAfiliadoController;

// Exportación a Excel
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RecepcionImport;

// Modelos
use App\RecepcionAfiliado;
use App\AporteAfiliado;
use App\Aporte;
use App\Models\Asiento;
use App\Afiliado;

class ReporteController extends Controller
{
    // Recepcion de leche
    public function recepcion_index(){
        return view('admin.reportes.recepciones.index');
    }

    public function importar_recepcion_list(Request $request){
        $periodo = date('Y-m-d', strtotime($request->anio.'-'.$request->mes.'-'.$request->dia));
        
        $recepciones = DB::table('recepcion_afiliado as ra')
                            ->join('afiliados as a', 'a.id', 'ra.afiliado_id')
                            ->selectRaw('a.id, ra.afiliado_id, a.nombre_completo, a.rau, SUM(ra.total_litros) as total_litros, ra.precio_unidad, ra.periodo')
                            ->where('ra.estado', 1)
                            ->whereDay('ra.periodo', $request->dia)
                            ->whereMonth('ra.periodo', $request->mes)
                            ->whereYear('ra.periodo', $request->anio)
                            ->groupBy('a.id', 'ra.periodo')
                            ->orderBy('a.nombre_completo', 'desc')
                            ->orderBy('ra.periodo', 'asc')
                            ->get();
        setlocale(LC_ALL, "es_ES");
        if(!$request->pdf){
            return view('admin.reportes.recepciones.recepciones_list', compact('recepciones', 'periodo'));
        }else{
            $vista = view('admin.reportes.recepciones.recepciones_list_pdf', compact('recepciones', 'periodo'));
            // return $vista;
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($vista)->setPaper('letter', 'landscape');
            return $pdf->stream();
        }
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
        return view('admin.reportes.recepciones.recepciones_view', compact('recepciones', 'mensualidad', 'aporte_leche'));
    }

    public function importar_recepcion_datos_store(Request $request){

        $periodo = date('Y-m-d', strtotime($request->anio.'-'.$request->mes.'-'.$request->dia));
        $recepcion_afiliado = RecepcionAfiliado::where('periodo', $periodo)->where('estado', 1)->first();
        if($recepcion_afiliado){
            return redirect('admin/importar/recepciones')->with(['message' => 'Ya se importó la recepción de leche de esta quincena, elija otra.', 'alert-type' => 'error']);
        }

        if($request->id){

            DB::beginTransaction();
            try {
                for ($i=0; $i < count($request->id); $i++) {
                    // Registrar ambos aportes en el detalle de recepción
                    $aporte_afiliado = AporteAfiliado::create([
                        'afiliado_id' => $request->afiliado_id[$i],
                        'aporte_id' => 1,
                        'monto' => $request->mensualidad[$i],
                        'periodo' => $periodo,
                        'periodo_fin' => $periodo
                    ]);

                    $afiliado = Afiliado::find($request->afiliado_id[$i]);

                    $asiento = collect([
                        'aporte_id' => 1,
                        'observacion' => 'Pago de quincena de '.($afiliado ? $afiliado->nombre_completo : 'Desconocido'),
                        'monto' => $request->mensualidad[$i],
                        'fecha' => $periodo
                    ]);

                    (new AporteAfiliadoController)->guardarasiento($asiento, $aporte_afiliado->id, $request->cuenta_name);

                    $aporte_afiliado = AporteAfiliado::create([
                        'afiliado_id' => $request->afiliado_id[$i],
                        'aporte_id' => 2,
                        'monto' => $request->aporte_leche[$i],
                        'periodo' => $periodo
                    ]);

                    $asiento = collect([
                        'aporte_id' => 2,
                        'observacion' => '',
                        'monto' => $request->aporte_leche[$i],
                        'fecha' => $periodo
                    ]);

                    (new AporteAfiliadoController)->guardarasiento($asiento, $aporte_afiliado->id, $request->cuenta_name);

                    if($request->aportes){
                        foreach ($request->aportes as $value) {
                            $id = explode('_', $value)[0];
                            $aporte_id = explode('_', $value)[1];
                            $aporte_monto = Aporte::find($aporte_id);

                            if($id == $request->id[$i]){
                                $aporte_afiliado = AporteAfiliado::create([
                                    'afiliado_id' => $request->afiliado_id[$i],
                                    'aporte_id' => $aporte_id,
                                    'monto' => $aporte_monto->monto,
                                    'periodo' => $periodo
                                ]);

                                $asiento = collect([
                                    'aporte_id' => $aporte_id,
                                    'observacion' => 'Cobro extra: '.$aporte_monto->nombre,
                                    'monto' => $aporte_monto->monto,
                                    'fecha' => $periodo
                                ]);
                
                                (new AporteAfiliadoController)->guardarasiento($asiento, $aporte_afiliado->id, $request->cuenta_name);
                            }
                        }
                    }

                    // Actualizar datos de recepción
                    RecepcionAfiliado::where('afiliado_id', $request->afiliado_id[$i])
                    ->where('estado', 0)->update([
                        'periodo' => $periodo,
                        'estado' => 1
                    ]);
                }
                DB::table('recepcion_afiliado')->where('estado', 0)->delete();
                DB::commit();
                return redirect('admin/importar/recepciones')->with(['message' => 'Recepción registrada exitosamenete.', 'alert-type' => 'success']);
            } catch (\Exception $e) {
                DB::rollback();
                return redirect('admin/importar/recepciones')->with(['message' => 'Ocurrió un error inesperado.', 'alert-type' => 'error']);
            }
        }else{
            return redirect('admin/importar/recepciones')->with(['message' => 'Debe importar datos de recepción de leche.', 'alert-type' => 'error']);
        }
    }

    // Afiliados
    public function afiliados_index(){
        return view('admin.reportes.afiliados.index');
    }

    public function afiliados_reporte(Request $request){
        $recepciones = DB::table('recepcion_afiliado as ra')
                            ->join('afiliados as a', 'a.id', 'ra.afiliado_id')
                            ->selectRaw('a.*, a.nombre_completo, a.rau, SUM(ra.total_litros) as total_litros, ra.precio_unidad, ra.periodo, ra.deleted_at as detalle')
                            ->where('ra.afiliado_id', $request->afiliado_id)
                            ->where('ra.estado', 1)
                            // ->whereMonth('ra.periodo', $request->mes)
                            // ->whereYear('ra.periodo', $request->anio)
                            ->groupBy('ra.periodo')
                            ->orderBy('ra.periodo', 'DESC')
                            ->get();
        $cont = 0;
        foreach ($recepciones as $value) {
            $detalle = DB::table('aporte_afiliado as af')
                            ->join('aportes as a', 'a.id', 'af.aporte_id')
                            ->select('a.nombre', 'af.monto', 'af.periodo')
                            ->where('af.periodo', $value->periodo)
                            ->where('af.afiliado_id', $value->id)->get();
            $recepciones[$cont]->detalle = $detalle;
            $cont++;
        }
        // dd($recepciones);
        return view('admin.reportes.afiliados.lista_aportes', compact('recepciones'));
    }

    public function lbdiario_index(){
        return view('admin.reportes.diario.index');
    }

    public function lbdiario_generate(Request $request){
        $fecha = $request->fecha;
        $diarios = Asiento::with(['user','items'])
                            ->whereHas('items', function($q) use ($fecha){
                                $q->where('fecha', $fecha);
                            })
                            // ->whereDay('created_at',$fecha->day)
                            ->where('deleted_at', NULL)
                            ->get();

        if ($request->printf == 'imprimir') {
            $vista = view('admin.reportes.diario.pdf', compact('diarios','fecha'));
            $pdf = \App::make('dompdf.wrapper');
            //  $pdf->loadHTML($vista);
            $pdf->loadHTML($vista)->setPaper('letter');
            return $pdf->stream();
        }

        return view('admin.reportes.diario.diario_list', compact('diarios','fecha'));
    }
    public function lbmayor_index(){
        return view('admin.reportes.mayor.index');
    }

    public function lbmayor_generate(Request $request){
        $f_inicio = $request->inicio;
        $f_fin    = $request->fin;

        $mayores = Asiento::selectRaw('det.codigo,det.name,sum(det.debe) AS Debe,sum(det.haber) AS Haber')
                        ->join('detalles as det', 'det.asiento_id', '=', 'asientos.id')
                        ->whereBetween('asientos.created_at',[$f_inicio,$f_fin])
                        ->where('deleted_at', NULL)
                        ->groupBy('det.codigo','det.name')
                        ->get();
        if ($request->printf == 'imprimir') {
            $vista = view('admin.reportes.mayor.pdf', compact('mayores','f_inicio','f_fin'));
            $pdf = \App::make('dompdf.wrapper');
            //  $pdf->loadHTML($vista);
            $pdf->loadHTML($vista)->setPaper('letter');
            return $pdf->stream();
        }

        return view('admin.reportes.mayor.mayor_list', compact('mayores','f_inicio','f_fin'));
    }

    public function balancegnral_index(){
        return view('admin.reportes.balance.index');
    }

    public function balancegnral_generate(Request $request){
        $f_inicio = $request->inicio;
        $f_fin    = $request->fin;

        $balance = Asiento::selectRaw('det.codigo,det.name,sum(det.debe) AS Debe,sum(det.haber) AS Haber,det.tipo')
                        ->join('detalles as det', 'det.asiento_id', '=', 'asientos.id')
                        ->whereBetween('asientos.created_at',[$f_inicio,$f_fin])
                        ->where('deleted_at', NULL)
                        ->groupBy('det.codigo','det.name')
                        ->get();
        if ($request->printf == 'imprimir') {
            $vista = view('admin.reportes.balance.pdf', compact('balance','f_inicio','f_fin'));
            $pdf = \App::make('dompdf.wrapper');
            //  $pdf->loadHTML($vista);
            $pdf->loadHTML($vista)->setPaper('letter');
            return $pdf->stream();
        }

        return view('admin.reportes.balance.balance_list', compact('balance','f_inicio','f_fin'));
    }

    // Comprobaciones de sumas y saldos

    public function comprobacion_index(){
        return view('admin.reportes.comprobacion.index');
    }

    public function comprobacion_generate(Request $request){
        
        $f_inicio = $request->inicio;
        $f_fin    = $request->fin;

        $mayores = Asiento::selectRaw('det.codigo,det.name,sum(det.debe) AS Debe,sum(det.haber) AS Haber')
                        ->join('detalles as det', 'det.asiento_id', '=', 'asientos.id')
                        ->whereBetween('asientos.created_at',[$f_inicio,$f_fin])
                        ->where('deleted_at', NULL)
                        ->groupBy('det.codigo','det.name')
                        ->get();
        if ($request->printf == 'imprimir') {
            $vista = view('admin.reportes.comprobacion.pdf', compact('mayores','f_inicio','f_fin'));
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($vista)->setPaper('letter');
            return $pdf->stream();
        }
            // return $balance;
        return view('admin.reportes.comprobacion.list', compact('mayores','f_inicio','f_fin'));
    }
}
