<?php

namespace App\Http\Controllers;

use App\Models\Asiento;
use Illuminate\Http\Request;

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
        $asientos = Asiento::orderBy('id', 'DESC')->get();
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
        //
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
        $cuenta = \App\Models\DetailAccount::where('sub_division',$filtro)
                                  ->select('id','sub_division','name')
                                  ->orderBy('id','asc')
                                  ->take(1)
                                  ->get();
        return response()->json([
            'cuenta' => $cuenta
        ]);
    }

    public function listarCuentas(Request $request)
    {
       // if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

         //obtengo los ids de los almacenes

        if ($buscar==''){
            $cuentas = \App\Models\DetailAccount::orderBy('id','desc')->paginate(10);
        }
        else{
            $cuentas = d\App\Models\DetailAccount::where('tomos.'. $criterio, 'like','%'. $buscar . '%')
                                        ->orderBy('id','desc')->paginate(10);
        }
        return response()->json([
            'data' => $cuentas
        ]);
    }

}
