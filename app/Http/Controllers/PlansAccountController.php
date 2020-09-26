<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlansAccountController extends Controller
{
    public function store(Request $request) {
        $arreglo = [
            'subcuentas'=> []
        ];
        $arreglo['subcuentas'] = $request->except(['_token','element_id']);

        $plan = \App\Models\PlansOfAccount::where('id',$request->element_id)->first();

        if (isset($plan->sub_account)) {
           $miarreglo= [];
           $miarreglo = $plan->sub_account;
           return $miarreglo;
        }else {
            $plan->sub_account = $arreglo;
        }
        $plan->save();
        return redirect()->back()->with(['message' => 'Cuenta agregada exitosamente.', 'alert-type' => 'success']);
    }
}
