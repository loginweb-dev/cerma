<?php

use Illuminate\Support\Facades\Route;
use App\Imports\TypeDocumentImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\CajaChicaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/admin');
});
Auth::routes();

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    // Aportes
    Route::resource('aporteafiliado', 'AporteAfiliadoController');

    // Mensualidades
    Route::resource('mensualidades', 'MensualidadesController');

    // Afiliados
    Route::get('afiliados/{id}/documentos', 'AfiliadosController@documentos')->name('afiliados.documentos');
    Route::post('afiliados/{id}/documentos/store', 'AfiliadosController@documentos_store')->name('afiliados.documentos.store');
    Route::post('afiliados/{id}/documentos/destroy', 'AfiliadosController@documentos_destroy')->name('afiliados.documentos.destroy');
    Route::get('afiliados/get/{dato}', 'AfiliadosController@get_afiliado');
    Route::get('afiliados/export/excel', 'AfiliadosController@export_excel')->name('afiliados.export.excel');

    // ============== Reportes =============

    // Importación de excel
    Route::get('importar/recepciones', 'ReporteController@recepcion_index');
    Route::post('importar/recepciones/list', 'ReporteController@importar_recepcion_list');
    Route::post('importar/recepciones/datos', 'ReporteController@importar_recepcion_datos');
    Route::get('importar/recepciones/datos/view', 'ReporteController@importar_recepcion_datos_view');
    Route::post('importar/recepciones/datos/store', 'ReporteController@importar_recepcion_datos_store');

    // Reporte de afiliados
    Route::get('reportes/afiliados', 'ReporteController@afiliados_index');
    Route::post('reportes/afiliados/lista', 'ReporteController@afiliados_reporte');

    // =====================================

    // Recibos
    Route::post('recibo/aportacion', 'RecibosController@recibo_aportacion');
    Route::post('recibo/pago', 'RecibosController@recibo_pago');
    Route::post('recibo/transaccion', 'RecibosController@recibo_dinero_afiliado');


    Route::get('{page_id}/edit', 'PageController@edit')->name('page_edit');
    Route::post('/page/{page_id}/update', 'PageController@update')->name('page_update');
    Route::get('/page/{page_id}/default', 'PageController@default')->name('page_default');


    Route::get('{page_id}/index', 'BlockController@index')->name('block_index');
    Route::post('/block/update/{block_id}', 'BlockController@update')->name('block_update');
    Route::get('/block/delete/{block_id}', 'BlockController@delete')->name('block_delete');
    Route::get('/block/order/{block_id}/{order}', 'BlockController@block_ordering');

    Route::get('/block/move_up/{block_id}', 'BlockController@move_up')->name('block_move_up');
    Route::get('/block/move_down/{block_id}', 'BlockController@move_down')->name('block_move_down');

    Route::resource('asientos','AsientosController');
    Route::post('add-comprobante/{id}','AsientosController@agregarcomprobante')->name('agregarcomprobante');
    Route::post('printf/asiento/{id}', 'AsientosController@printf_asiento')->name('printf_asiento');

    //ruta para buscar por codigo las cuentas
    Route::get('planes_cuentas/buscarcuenta','AsientosController@buscarCuenta');
    Route::get('planes_cuentas/listarcuentas','AsientosController@listarCuentas');

    //ruta para agregar las cuentas a los elementos
    Route::get('add_account/{id}',function($id){
        $plan = \App\Models\PlansOfAccount::with('detailaccounts')
                                            ->where('id',$id)->first();
        //return $plan;
        return view('admin.PlanOfAccount.AddAccount', [
            'cuenta' => $plan,
            'element_id' => $plan->id
            ]
        );
    })->name('add_account');
    Route::post('store_account','PlansAccountController@store')->name('store_account');

    //rutas para reportes
    Route::get('reports/lbdiario','ReporteController@lbdiario_index')->name('lbdiario_index');
    Route::post('reports/lbdiario/list', 'ReporteController@lbdiario_generate');

    Route::get('reports/lbmayor','ReporteController@lbmayor_index')->name('lbmayor_index');
    Route::post('reports/lbmayor/list', 'ReporteController@lbmayor_generate');

    Route::get('reports/balancegnral','ReporteController@balancegnral_index')->name('balancegnral_index');
    Route::post('reports/balancegnral/list', 'ReporteController@balancegnral_generate');

    Route::get('reports/comprobacion','ReporteController@comprobacion_index')->name('comprobacion_index');
    Route::post('reports/comprobacion/list', 'ReporteController@comprobacion_generate');

    //ruta para importar los tipos de documentos
    Route::get('import-document', function () {
        Excel::import(new TypeDocumentImport, 'subcuentas.xlsx');
        return 'importacion con exito';
    });

    //rutas pagos
    Route::resource('pagos', 'PagoController');
    Route::get('/pagos/imprimir', function () {
        return 'hola';
    });

    //rutas cajachica
    Route::resource('cajachica', 'CajaChicaController');

    //rutas dinero afiliado (pagos y cobros juntos)
    Route::resource('dineroafiliados', 'DineroAfiliadoController');
});

