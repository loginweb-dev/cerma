<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Controllers
use App\Http\Controllers\LoginWebController as LoginWeb;

// Models
use App\Afiliado;
use App\AfiliadosDocumento;

class AfiliadosController extends Controller
{
    public function documentos($id){
        $documentos = AfiliadosDocumento::where('afiliado_id', $id)->get();
        return view('admin.afiliados.documentos_index', compact('id', 'documentos'));
    }

    public function documentos_store($id, Request $request){
        if($request->hasFile('file')) {
            DB::beginTransaction();
            try{
                $imagen = (new LoginWeb)->save_image($request->file('file'), 'afiliados_documentos');
                if($imagen){
                    AfiliadosDocumento::create([
                        'afiliado_id' => $id,
                        'titulo' => $request->titulo,
                        'imagen' => $imagen
                    ]);
                }
                DB::commit();
                return redirect()->route('afiliados.documentos', ['id' => $id])->with(['message' => 'Documento agregado correctamente.', 'alert-type' => 'success']);
            }catch (\Throwable $th) {
                DB::rollback();
                return redirect()->route('afiliados.documentos', ['id' => $id])->with(['message' => 'Ocurrió un error inesperado.', 'alert-type' => 'error']);
            }
        }else{
            return redirect()->route('afiliados.documentos', ['id' => $id])->with(['message' => 'Archivo no válido.', 'alert-type' => 'error']);
        }
    }

    public function documentos_destroy($id, Request $request){
        try {
            AfiliadosDocumento::destroy($id);
            return redirect()->route('afiliados.documentos', ['id' => $request->afiliado_id])->with(['message' => 'Documento eliminado correctamente.', 'alert-type' => 'success']);
        } catch (\Throwable $th) {
            return redirect()->route('afiliados.documentos', ['id' => $request->afiliado_id])->with(['message' => 'Ocurrió un error inesperado.', 'alert-type' => 'error']);
        }
    }

    public function get_afiliado($dato){
        return Afiliado::whereRaw("(nombre_completo like '%$dato%' or ci like '%$dato%' or rau like '%$dato%')")->get();
    }
}
