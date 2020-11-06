<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Controllers\AporteAfiliadoController;

// Models
use App\Afiliado;
use App\AporteAfiliado;

class MensualidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('search');
        $query = $search ? "nombre_completo like '%$search%' or rau like '%$search%' or ci like '%$search%'" : 1;
        $mensualidades = Afiliado::where('deleted_at', NULL)->whereRaw($query)->paginate(20);
        return view('admin.mensualidades.browse', compact('mensualidades', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            if(isset($request->intervalo)){
                $periodo = date('d', strtotime($request->periodo)) < 15 ? date('Y-m', strtotime($request->periodo)).'-01' : date('Y-m', strtotime($request->periodo)).'-15';
                $periodo_fin = date('d', strtotime($request->periodo_fin)) < 15 ? date('Y-m', strtotime($request->periodo_fin)).'-01' : date('Y-m', strtotime($request->periodo_fin)).'-15';
                
                while ($periodo <= $periodo_fin) {
                    $dia = date('d', strtotime($periodo));
                    if($dia < 15){
                        $periodo = date('Y-m', strtotime($periodo)).'-15';
                    }else{
                        $periodo = date('Y-m', strtotime("+1 month", strtotime($periodo))).'-01';
                    }

                    // Registrar aporte
                    $aporte_afiliado = AporteAfiliado::create([
                        'aporte_id' => 1,
                        'afiliado_id' => $request->afiliado_id,
                        'monto' => $request->monto,
                        'observacion' => $request->observacion,
                        'periodo' => $periodo,
                        'periodo_fin' => $periodo
                    ]);
        
                    // Registrar asiento contable
                    $asiento = collect([
                        'aporte_id' => 1,
                        'observacion' => $request->observacion,
                        'monto' => $request->monto,
                        'fecha' => $periodo
                    ]);
                    (new AporteAfiliadoController)->guardarasiento($asiento, $aporte_afiliado->id);
                }
                Afiliado::where('id', $request->afiliado_id)->update([
                    'fecha_ultimo_pago' => $periodo_fin
                ]);
            }else{
                // Registrar aporte
                $aporte_afiliado = AporteAfiliado::create([
                    'aporte_id' => 1,
                    'afiliado_id' => $request->afiliado_id,
                    'monto' => $request->monto,
                    'observacion' => $request->observacion,
                    'periodo' => $request->periodo,
                    'periodo_fin' => $request->periodo
                ]);
    
                // Registrar asiento contable
                $asiento = collect([
                    'aporte_id' => 1,
                    'observacion' => $request->observacion,
                    'monto' => $request->monto,
                    'fecha' => $request->periodo
                ]);
                (new AporteAfiliadoController)->guardarasiento($asiento, $aporte_afiliado->id);
                Afiliado::where('id', $request->afiliado_id)->update([
                    'fecha_ultimo_pago' => $request->periodo
                ]);
            }
            DB::commit();
            return redirect()->route('mensualidades.index')->with(['message' => 'Pago de quincena agregada exitosamente.', 'alert-type' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('mensualidades.index')->with(['message' => 'Ocurrió un error inesperado.', 'alert-type' => 'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
