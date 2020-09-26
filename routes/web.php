<?php

use Illuminate\Support\Facades\Route;

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

    // Afiliados
    Route::get('afiliados/get/{dato}', 'AfiliadosController@get_afiliado');

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


    Route::get('{page_id}/edit', 'PageController@edit')->name('page_edit'); 
    Route::post('/page/{page_id}/update', 'PageController@update')->name('page_update');
    Route::get('/page/{page_id}/default', 'PageController@default')->name('page_default'); 


    Route::get('{page_id}/index', 'BlockController@index')->name('block_index'); 
    Route::post('/block/update/{block_id}', 'BlockController@update')->name('block_update');
    Route::get('/block/delete/{block_id}', 'BlockController@delete')->name('block_delete');
    Route::get('/block/order/{block_id}/{order}', 'BlockController@block_ordering');

    Route::get('/block/move_up/{block_id}', 'BlockController@move_up')->name('block_move_up'); 
    Route::get('/block/move_down/{block_id}', 'BlockController@move_down')->name('block_move_down');

    //ruta para agregar las cuentas a los elementos
    Route::get('add_account/{id}',function($id){
        return view('admin.PlanOfAccount.AddAccount', [
            'element_id' => $id
            ]
        );
    })->name('add_account');
    Route::post('store_account','PlansAccountController@store')->name('store_account');
});

