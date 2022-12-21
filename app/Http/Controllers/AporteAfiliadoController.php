<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Models
use App\Aporte;
use App\AporteAfiliado;
use Carbon\Carbon;
class AporteAfiliadoController extends Controller
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
        $cobros = AporteAfiliado::with(['afiliado', 'aporte'])
                        ->whereHas('afiliado', function($q) use ($query){
                            $q->whereRaw($query);
                        })
                        ->where('periodo', NULL)->where('deleted_at', null)
                        ->orderBy('id', 'DESC')->get();
        return view('admin.cobros.browse', compact('cobros', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $aportes = Aporte::where('deleted_at', null)->where('id', '>', 2)->get();
        $aportes = Aporte::where('deleted_at', null)->get();
        return view('admin.cobros.add', compact('aportes'));
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
            $redirect = $request->return ? 'aporteafiliado.create' : 'aporteafiliado.index';
            $aporte_afiliado = AporteAfiliado::create([
                'aporte_id' => $request->aporte_id,
                'afiliado_id' => $request->afiliado_id,
                'monto' => $request->monto,
                'observacion' => $request->observacion
            ]);

            $asiento = collect([
                'aporte_id' => $request->aporte_id,
                'observacion' => $request->observacion,
                'monto' => $request->monto,
                'fecha' => $request->fecha
            ]);

            $this->guardarasiento($request, $aporte_afiliado->id);
            DB::commit();
            return redirect()->route($redirect)->with(['message' => 'Cobro registrado exitosamente.', 'alert-type' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route($redirect)->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
        }
    }

    public function guardarasiento($data, $aporte_afiliado_id = null, $cuenta_debe_nombre = 'CAJA', $ingreso = true) {
        DB::beginTransaction();
        try {
            $aporte = Aporte::findOrFail($data['aporte_id']);
            $cuenta = \App\Models\PlansOfAccount::where('name','OTROS INGRESOS')->first();
            $ultimoitem = $cuenta->detailaccounts()->latest()->orderBy('id','desc')->first();
            $verifay = ($aporte->nombre === $ultimoitem->name)? true : false;
            if (!$verifay) {
            $cuenta->detailaccounts()->create([
                    'code' => $ultimoitem->code +1,
                    'name' => $aporte->nombre,
                ]);
                $ultimoitem = $cuenta->detailaccounts()->latest()->orderBy('id','desc')->first();
            }

            //guardar el asiento
            $asiento = new \App\Models\Asiento;
            $asiento->user_id = auth()->user()->id;
            $asiento->ufu = 0;
            $asiento->tipo_cambio = 0;
            $asiento->glosa = $data['observacion'];
            $asiento->total_haber = $data['monto'];
            $asiento->total_debe = $data['monto'];
            $asiento->aporte_afiliado_id = $aporte_afiliado_id;
            $asiento->save();

            //obtenemos la cuenta de caja para el primer registro del asiento
            $cuenta_debe = \App\Models\DetailAccount::where('name', $cuenta_debe_nombre)->first();

            $arreglo = [
                [
                    'fecha' => $data['fecha'],
                    'codigo' => $ingreso ? $cuenta_debe->code : $ultimoitem->code,
                    'name' => $ingreso ? $cuenta_debe->name : $ultimoitem->name,
                    'debe' => $data['monto'],
                    'haber' => 0,
                    'tipo' => $cuenta->tipo
                ],
                [
                    'fecha' => $data['fecha'],
                    'codigo' => $ingreso ? $ultimoitem->code : $cuenta_debe->code,
                    'name' => $ingreso ? $ultimoitem->name : $cuenta_debe->name,
                    'debe' => 0,
                    'haber' => $data['monto'],
                    'tipo' => $cuenta->tipo
                ]
            ];
            $asiento->storeHasMany([
                'items' => $arreglo
            ]);

            DB::commit();
            return $asiento;
        } catch (\Exception $e) {
            DB::rollback();
            return null;
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
        DB::beginTransaction();
        try {
            DB::table('aporte_afiliado')->where('id', $id)->update(['deleted_at' => date('Y-m-d H:i:s')]);
            DB::table('asientos')->where('aporte_afiliado_id', $id)->update(['deleted_at' => date('Y-m-d H:i:s')]);

            DB::commit();
            return redirect()->route('aporteafiliado.index')->with(['message' => 'Cobro registrado exitosamente.', 'alert-type' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('aporteafiliado.index')->with(['message' => 'Error inesperado.', 'alert-type' => 'error']);
        }
    }
}
