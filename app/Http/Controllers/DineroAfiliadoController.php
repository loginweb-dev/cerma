<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Aporte;
use App\Cuenta;
use App\DineroAfiliado;
use TCG\Voyager\Models\User;
use Illuminate\Support\Facades\Auth;

class DineroAfiliadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return view('admin.dineroafiliados.index');


        $search = request('search');
        $query = $search ? "nombre_completo like '%$search%' or rau like '%$search%' or ci like '%$search%'" : 1;
        $dineroafiliados = DineroAfiliado::with(['afiliado'])
                        ->whereHas('afiliado', function($q) use ($query){
                            $q->whereRaw($query);
                        })
                        ->where('deleted_at', null)
                        ->orderBy('id', 'DESC')->get();
        return view('admin.dineroafiliados.index', compact('dineroafiliados', 'search'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cuentas = Cuenta::where('deleted_at', null)->get();
        return view('admin.dineroafiliados.create', compact('cuentas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
          //guardar el asiento
         

       
        // DB::beginTransaction();
        // try {
            $cobros= json_decode( $_POST[ 'cobros' ] );
            $redirect = $request->return ? 'dineroafiliados.create' : 'dineroafiliados.index';
            // $dineroafiliados = DineroAfiliado::create([
            //     'afiliado_id' => intval($request->afiliado_id),
            //     'litros'=> floatval($request->litros), 
            //     'precio_unitario'=> floatval($request->precio_unitario), 
            //     'total_leche'=> floatval($request->total_leche), 
            //     'total_cobro'=> floatval($request->total_cobro), 
            //     'total_a_pagar'=> floatval($request->total_a_pagar), 
            //     'observaciones'=> $request->observaciones
            // ]);

            $dineroafiliados = DineroAfiliado::create([
                'afiliado_id' => intval( $_POST['afiliado_id']),
                'litros'=> floatval( $_POST['litros']),
                'precio_unitario'=> floatval( $_POST['precio_unitario']),
                'total_leche'=> floatval( $_POST['total_leche']),
                'total_cobro'=> floatval( $_POST['total_cobro']),
                'total_a_pagar'=> floatval( $_POST['total_a_pagar']),
                'observaciones'=> ( $_POST['observaciones']),
            ]);

            //guardar el asiento
            $asiento = new \App\Models\Asiento;
            $asiento->user_id = Auth::user()->id;
            $asiento->ufu = 0;
            $asiento->tipo_cambio = 0;
            $asiento->glosa = $_POST['observaciones'];
            $asiento->total_haber = floatval($_POST['total_leche']);
            $asiento->total_debe = floatval($_POST['total_leche']);
            $asiento->dineroafiliado_id = $dineroafiliados->id;
            $asiento->save();

            $cuenta_debe_nombre = 'CAJA'; 
            $ingreso = true;
            //obtenemos la cuenta de caja para el primer registro del asiento
            $cuenta_debe = \App\Models\DetailAccount::where('name', $cuenta_debe_nombre)->with('cuenta')->first();
            
            foreach ($cobros as $item) {

                // $cuenta= \App\Cuenta::find(intval($item->id));

                $cuenta_haber= \App\Models\DetailAccount::where('code', floatval($item->codigo))->with('cuenta')->first();
                $arreglo = [
                    [
                        'fecha' => $asiento->created_at,
                        'codigo' => $ingreso ? $cuenta_debe->code : $ultimoitem->code,
                        'name' => $ingreso ? $cuenta_debe->name : $ultimoitem->name,
                        'debe' => floatval($item->monto),
                        'haber' => 0,
                        'tipo' => $cuenta_debe->cuenta->tipo
                    ],
                    [
                        'fecha' => $asiento->created_at,
                        'codigo' => $ingreso ? $cuenta_haber->code : $cuenta_debe->code,
                        'name' => $ingreso ? $cuenta_haber->name : $cuenta_debe->name,
                        'debe' => 0,
                        'haber' => floatval($item->monto),
                        'tipo' => $cuenta_haber->cuenta->tipo
                    ]
                ];
                $asiento->storeHasMany([
                    'items' => $arreglo
                ]);
            }

            $cuenta_haber= \App\Models\PlansOfAccount::where('code', 111200)->first();
            $arreglo = [
                [
                    'fecha' => $asiento->created_at,
                    'codigo' => $ingreso ? $cuenta_haber->code : $cuenta_debe->code,
                    'name' => $ingreso ? $cuenta_haber->name : $cuenta_debe->name,
                    'debe' => floatval( $_POST['total_a_pagar']),
                    'haber' => 0,
                    'tipo' => $cuenta_haber->tipo
                ],
                [
                    'fecha' => $asiento->created_at,
                    'codigo' => $ingreso ? $cuenta_debe->code : $ultimoitem->code,
                    'name' => $ingreso ? $cuenta_debe->name : $ultimoitem->name,
                    'debe' => 0,
                    'haber' => floatval( $_POST['total_a_pagar']),
                    'tipo' => $cuenta_debe->cuenta->tipo
                ]
               
            ];
            $asiento->storeHasMany([
                'items' => $arreglo
            ]);

            return true;


            //$this->guardarasiento($request, $dineroafiliados->id, $cobros);
        //     DB::commit();
        //     return redirect()->route($redirect)->with(['message' => 'Transacción registrada exitosamente.', 'alert-type' => 'success']);
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return redirect()->route($redirect)->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
        // }
    }

    public function guardarasiento($data, $dineroafiliados = null, $cobros) {
        DB::beginTransaction();
        try {
            // $aporte = Aporte::findOrFail($data['aporte_id']);
            // $cuenta = \App\Models\PlansOfAccount::where('name','OTROS INGRESOS')->first();
            // $ultimoitem = $cuenta->detailaccounts()->latest()->orderBy('id','desc')->first();
            // $verifay = ($aporte->nombre === $ultimoitem->name)? true : false;
            // if (!$verifay) {
            // $cuenta->detailaccounts()->create([
            //         'code' => $ultimoitem->code +1,
            //         'name' => $aporte->nombre,
            //     ]);
            //     $ultimoitem = $cuenta->detailaccounts()->latest()->orderBy('id','desc')->first();
            // }

            //guardar el asiento
            $asiento = new \App\Models\Asiento;
            $asiento->user_id = auth()->user()->id;
            $asiento->ufu = 0;
            $asiento->tipo_cambio = 0;
            $asiento->glosa = $data['observaciones'];
            $asiento->total_haber = $data['total_leche'];
            $asiento->total_debe = $data['total_leche'];
            $asiento->dineroafiliado = $dineroafiliados;
            $asiento->save();


            $cuenta_debe_nombre = 'CAJA'; 
            $ingreso = true;
            //obtenemos la cuenta de caja para el primer registro del asiento
            $cuenta_debe = \App\Models\DetailAccount::where('name', $cuenta_debe_nombre)->first();
            //Registro de Cobros
            foreach ($cobros as $item) {

                $cuenta= \App\Cuenta::find(intval($item->id));
                $cuenta_haber= \App\Models\DetailAccount::find($item->codigo);
                $arreglo = [
                    [
                        'fecha' => $asiento->created_at,
                        'codigo' => $ingreso ? $cuenta_debe->code : $ultimoitem->code,
                        'name' => $ingreso ? $cuenta_debe->name : $ultimoitem->name,
                        'debe' => floatval($item->monto),
                        'haber' => 0,
                        //'tipo' => $cuenta->tipo
                    ],
                    [
                        'fecha' => $asiento->created_at,
                        'codigo' => $ingreso ? $cuenta_haber->code : $cuenta_debe->code,
                        'name' => $ingreso ? $cuenta_haber->name : $cuenta_debe->name,
                        'debe' => 0,
                        'haber' => floatval($item->monto),
                        //'tipo' => $cuenta->tipo
                    ]
                ];
                $asiento->storeHasMany([
                    'items' => $arreglo
                ]);
            }
            


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
        //
    }
}
