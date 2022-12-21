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
        'codigo'=>$subcuenta->code
    ]);

    return $subcuenta;
});
