<?php

namespace App\Http\Controllers;



use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Pago;
use App\PagoOption;
use Carbon\Carbon;


class PagoController extends Controller
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
        $pagos = Pago::with(['afiliado', 'pago_option'])
        ->whereHas('afiliado', function($q) use ($query){
            $q->whereRaw($query);
        })
        ->where('periodo', NULL)->where('deleted_at', null)
        ->orderBy('id', 'DESC')->get();
        return view('admin.pagos.index', compact('pagos', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pago_option = PagoOption::where('deleted_at', null)->get();
        return view('admin.pagos.create', compact('pago_option'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $pago = PagoOption::findOrFail($request->pago_id);
        // $cuenta_basic = \App\Cuenta::findOrFail($pago->cuenta_id);
        // $cuenta = \App\Models\PlansOfAccount::findOrFail($cuenta_basic->plan_de_cuenta_id);
        // $ultimoitem = $cuenta->detailaccounts()->latest()->orderBy('id','desc')->first();

        // return $ultimoitem->name;
        
        DB::beginTransaction();
        try {
            $redirect = $request->return ? 'pagos.create' : 'pagos.index';
            $pago = Pago::create([
                'pago_id' => $request->pago_id,
                'afiliado_id' => $request->afiliado_id,
                'monto' => $request->monto,
                'observacion' => $request->observacion
            ]);

            $asiento = collect([
                'pago_id' => $request->pago_id,
                'observacion' => $request->observacion,
                'monto' => $request->monto,
                'fecha' => $request->fecha
            ]);

            $this->guardarasiento($request, $pago->id);
            DB::commit();
            return redirect()->route($redirect)->with(['message' => 'Cobro registrado exitosamente.', 'alert-type' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route($redirect)->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
        }
    }

    public function guardarasiento($data,  $pago_id = null, $cuenta_debe_nombre = 'CAJA', $ingreso = true) {
        DB::beginTransaction();
        try {
            $pago = PagoOption::findOrFail($data->pago_id);
            $cuenta_basic = \App\Cuenta::findOrFail($pago->cuenta_id);
            $cuenta = \App\Models\PlansOfAccount::findOrFail($cuenta_basic->plan_de_cuenta_id);
            // $cuenta = \App\Models\PlansOfAccount::where('name', $plan_cuenta->name)->first();

            $ultimoitem = $cuenta->detailaccounts()->latest()->orderBy('id','desc')->first();
            $verifay = ($pago->nombre === $ultimoitem->name)? true : false;
            if (!$verifay) {
            $cuenta->detailaccounts()->create([
                    'code' => $ultimoitem->code +1,
                    'name' => $pago->nombre,
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

            // $asiento->pago_id = $pago_id;
            $asiento->save();

            //obtenemos la cuenta de caja para el primer registro del asiento
            $cuenta_debe = \App\Models\DetailAccount::where('name', $cuenta_debe_nombre)->first();

            $arreglo = [
                [
                    'fecha' => $data['fecha'],
                    'codigo' => $ingreso ? $cuenta_debe->code : $ultimoitem->code,
                    'name' => $ingreso ? $cuenta_debe->name : $ultimoitem->name,
                    'debe' => 0,
                    'haber' => $data['monto'],
                    'tipo' => $cuenta->tipo
                ],
                [
                    'fecha' => $data['fecha'],
                    'codigo' => $ingreso ? $ultimoitem->code : $cuenta_debe->code,
                    'name' => $ingreso ? $ultimoitem->name : $cuenta_debe->name,
                    'debe' => $data['monto'],
                    'haber' => 0,
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
            DB::table('pagos')->where('id', $id)->update(['deleted_at' => date('Y-m-d H:i:s')]);
            DB::table('asientos')->where('pago_id', $id)->update(['deleted_at' => date('Y-m-d H:i:s')]);

            DB::commit();
            return redirect()->route('pagos.index')->with(['message' => 'Pago registrado exitosamente.', 'alert-type' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('pagos.index')->with(['message' => 'Error inesperado.', 'alert-type' => 'error']);
        }
    }
}
