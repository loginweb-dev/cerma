<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Models
use App\Aporte;
use App\AporteAfiliado;

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
        $aportes = Aporte::where('deleted_at', null)->where('tipo', 'monto')->get();
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
            $aporte = AporteAfiliado::create([
                'aporte_id' => $request->aporte_id,
                'afiliado_id' => $request->afiliado_id,
                'monto' => $request->monto,
                'observacion' => $request->observacion
            ]);

            DB::commit();
            return redirect()->route($redirect)->with(['message' => 'Cobro registrado exitosamente.', 'alert-type' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route($redirect)->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
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
        DB::table('aporte_afiliado')->where('id', $id)
            ->update([
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
        return redirect()->route('aporteafiliado.index')->with(['message' => 'Cobro registrado exitosamente.', 'alert-type' => 'success']);
    }
}
