<?php

namespace App\Http\Controllers;

use App\Models\Asiento;
use Illuminate\Http\Request;
use DB;
class AsientosController extends Controller
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
        $asientos = Asiento::orderBy('id', 'DESC')->paginate(10);
        return view('admin.asientos.index', compact('asientos', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.asientos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $asiento = new Asiento;
        $asiento->user_id = auth()->user()->id;
        $asiento->ufu = $request->ufu;
        $asiento->tipo_cambio = $request->tipo;
        $asiento->glosa = $request->glosa;
        $asiento->total_haber = collect($request->items)->sum(function($item) {
            return $item['haber'];
        });
        $asiento->total_debe = collect($request->items)->sum(function($item) {
            return $item['debe'];
        });
        $asiento = DB::transaction(function() use ($asiento, $request) {
            // custom method from app/Helper/HasManyRelation
            $asiento->storeHasMany([
                'items' => $request->items
            ]);
            return $asiento;
        });

        return response()
            ->json(['saved' => true, 'id' => $asiento->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asiento  $asiento
     * @return \Illuminate\Http\Response
     */
    public function show(Asiento $asiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asiento  $asiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Asiento $asiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asiento  $asiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asiento $asiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asiento  $asiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asiento $asiento)
    {
        //
    }

    public function buscarCuenta(Request $request){
        $filtro = $request->filtro;
        $cuenta = \App\Models\DetailAccount::join('plans_of_accounts as plan','plan.id','=','detail_accounts.plan_of_account_id')
                                  ->where('detail_accounts.code',$filtro)
                                  ->select('detail_accounts.id','detail_accounts.code','detail_accounts.name','plan.tipo')
                                  ->orderBy('detail_accounts.id','asc')
                                  ->take(1)
                                  ->get();
        return response()->json([
            'cuenta' => $cuenta
        ]);
    }

    public function listarCuentas(Request $request)
    {
        if (!$request->ajax()) return redirect('/admin');
        $buscar = $request->buscar;
        if ($buscar==''){
            $cuentas = \App\Models\DetailAccount::join('plans_of_accounts as plan','plan.id','=','detail_accounts.plan_of_account_id')
                                                  ->select('detail_accounts.id','detail_accounts.code','detail_accounts.name','plan.tipo')
                                                  ->orderBy('detail_accounts.id','asc')
                                                  ->paginate(10);
        }
        else{
            $cuentas = \App\Models\DetailAccount::join('plans_of_accounts as plan','plan.id','=','detail_accounts.plan_of_account_id')
                                                    ->where('detail_accounts.code', 'like','%'. $buscar . '%')
                                                    ->orWhere('detail_accounts.name', 'like','%'. $buscar . '%')
                                                    ->select('detail_accounts.id','detail_accounts.code','detail_accounts.name','plan.tipo')
                                                    ->orderBy('detail_accounts.id','asc')
                                                    ->orderBy('id','desc')->paginate(10);
        }
        return response()->json([
            'data' => $cuentas
        ]);
    }

}
