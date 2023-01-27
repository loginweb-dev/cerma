<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('save/cuenta', function(Request $request){
//     $cuenta= \App\Cuenta::create([
//         'nombre'=> $request->nombre, 
//         'detalles'=>$request->detalles, 
//         'plan_de_cuenta_id' =>$request->plan_de_cuenta_id, 
//         'codigo'=>$request->codigo
//     ]);
//     return $cuenta;
// });

Route::post('create/subcuenta', function(Request $request){
    if ($request->id>0) {
        $cuenta= \App\Cuenta::find($request->id);
        $cuenta->nombre=$request->name;
        $cuenta->detalles=$request->detalles;
        $cuenta->plan_de_cuenta_id=$request->plan_of_account_id;
        $cuenta->monto=$request->monto;
        $cuenta->tipo_retencion=$request->tipo_retencion;
        $cuenta->save();
        $detalle= \App\Models\DetailAccount::where('code', $cuenta->codigo)->first();
        $detalle->name=$request->name;
        $detalle->save();
        return true;
    }
    else{
        $cuenta = \App\Models\PlansOfAccount::find($request->plan_of_account_id);
        $ultimoitem = $cuenta->detailaccounts()->latest()->orderBy('id','desc')->first();
        $cuenta->detailaccounts()->create([
            'code' => $ultimoitem->code +1,
            'name' => $request->name,
        ]);
        $subcuenta = $cuenta->detailaccounts()->latest()->orderBy('id','desc')->first();
        $cuenta_aporte= \App\Cuenta::create([
            'nombre'=> $request->name, 
            'detalles'=>$request->detalles, 
            'plan_de_cuenta_id' =>$request->plan_of_account_id, 
            'codigo'=>$subcuenta->code,
            'monto'=>$request->monto,
            'tipo_retencion'=>$request->tipo_retencion
        ]);

        return $subcuenta;
    }
});

Route::get('find/cuentas/default', function(){
    return \App\Cuenta::where('created_at','!=',null)->limit(4)->get();
});
