<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlansAccountController extends Controller
{
    public function store(Request $request) {
        $plan = \App\Models\PlansOfAccount::where('id',$request->cuenta_id)->first();
        $detail = new \App\Models\DetailAccount;
        $detail->plan_of_account_id = $plan->id;
        $detail->code = $request->code;
        $detail->name= $request->name;
        $detail->save();
        return redirect()->back()->with(['message' => 'Cuenta agregada exitosamente.', 'alert-type' => 'success']);
    }
}
