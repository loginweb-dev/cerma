<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\CajaChica;

class CajaChicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('search');
        $query = $search ? "glosa like '%$search%' or rau like '%$search%' or ci like '%$search%'" : 1;
        $movimientos = CajaChica::with(['cuenta_debe', 'cuenta_haber', 'user'])
        ->where('deleted_at', null)
        ->where('glosa', 'like', '%'.$search.'%')
        ->orderBy('id', 'DESC')->get();
        return view('admin.cajachica.index', compact('movimientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $plan_de_cuentas= \App\Models\PlansOfAccount::where('deleted_at', null)->get();
        return view('admin.cajachica.create', compact('plan_de_cuentas'));
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
            $redirect = $request->return ? 'cajachica.create' : 'cajachica.index';
            $caja_chica= CajaChica::create([
                'glosa'=> $request->glosa, 
                'monto'=> $request->monto, 
                'tipo_movimiento'=> $request->tipo_movimiento, 
                'cuenta_debe_id'=> $request->cuenta_debe_id, 
                'cuenta_haber_id'=> $request->cuenta_haber_id,
                'user_id'=>auth()->user()->id
            ]);

            //guardar el asiento
            $asiento = new \App\Models\Asiento;
            $asiento->user_id = auth()->user()->id;
            $asiento->ufu = 0;
            $asiento->tipo_cambio = 0;
            $asiento->glosa = $request['glosa'];
            $asiento->total_haber = $request['monto'];
            $asiento->total_debe = $request['monto'];
            $asiento->save();

            $cuenta_debe= \App\Models\PlansOfAccount::find($request->cuenta_debe_id);
            $cuenta_haber= \App\Models\PlansOfAccount::find($request->cuenta_haber_id);
            if ($request->tipo_movimiento=="1") {
                $arreglo = [
                    [
                        'fecha' => $request['fecha'],
                        'codigo' => $cuenta_debe->code,
                        'name' => $cuenta_debe->name,
                        'debe' => $request['monto'],
                        'haber' => 0,
                        'tipo' => $cuenta_debe->tipo
                    ],
                    [
                        'fecha' => $request['fecha'],
                        'codigo' => $cuenta_haber->code,
                        'name' => $cuenta_haber->name,
                        'debe' => 0,
                        'haber' => $request['monto'],
                        'tipo' => $cuenta_haber->tipo
                    ]
                ];
            }
            else{
                $arreglo = [
                    [
                        'fecha' => $request['fecha'],
                        'codigo' => $cuenta_debe->code,
                        'name' => $cuenta_debe->name,
                        'debe' => 0,
                        'haber' => $request['monto'],
                        'tipo' => $cuenta_debe->tipo
                    ],
                    [
                        'fecha' => $request['fecha'],
                        'codigo' => $cuenta_haber->code,
                        'name' => $cuenta_haber->name,
                        'debe' => $request['monto'],
                        'haber' => 0,
                        'tipo' => $cuenta_haber->tipo
                    ]
                ];
            }
        
            $asiento->storeHasMany([
                'items' => $arreglo
            ]);


            // return $caja_chica;

            // $this->guardarasiento($request);
            DB::commit();
            return redirect()->route($redirect)->with(['message' => 'Cobro registrado exitosamente.', 'alert-type' => 'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route($redirect)->with(['message' => 'Ocurrió un error.', 'alert-type' => 'error']);
        }
    }
    public function guardarasiento($request) {
        DB::beginTransaction();
        try {
       
            
            //guardar el asiento
            $asiento = new \App\Models\Asiento;
            $asiento->user_id = auth()->user()->id;
            $asiento->ufu = 0;
            $asiento->tipo_cambio = 0;
            $asiento->glosa = $request['glosa'];
            $asiento->total_haber = $request['monto'];
            $asiento->total_debe = $request['monto'];
            $asiento->save();

            $cuenta_debe= \App\Models\PlansOfAccount::find($request->cuenta_debe_id);
            $cuenta_haber= \App\Models\PlansOfAccount::find($request->cuenta_haber_id);


            $arreglo = [
                [
                    'fecha' => $request['fecha'],
                    'codigo' => $cuenta_debe->code,
                    'name' => $cuenta_debe->name,
                    'debe' => 0,
                    'haber' => $request['monto'],
                    'tipo' => $cuenta_debe->tipo
                ],
                [
                    'fecha' => $request['fecha'],
                    'codigo' => $cuenta_haber->code,
                    'name' => $cuenta_haber->name,
                    'debe' => $request['monto'],
                    'haber' => 0,
                    'tipo' => $cuenta_haber->tipo
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
        //
    }
}
