<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlansAccountController extends Controller
{
    public function store(Request $request) {
        $plan = \App\Models\PlansOfAccount::where('id',$request->element_id)->first();
        $detail = new \App\Models\DetailAccount;
        $detail->plan_of_account_id = $plan->id;
        $detail->sub_account = $request->sub_account;
        $detail->division= $request->division;
        $detail->sub_division= $request->sub_division;
        $detail->name= $request->name;
        $detail->tipo= $request->tipo;
        $detail->grupo= $request->grupo;
        $detail->save();
        return redirect()->back()->with(['message' => 'Cuenta agregada exitosamente.', 'alert-type' => 'success']);
    }
}
