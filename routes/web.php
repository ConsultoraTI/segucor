<?php

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
    return view('welcome');
});

Route::get('/Presupuestos/Crear', 'Presupuestos@crear');
Route::post('/Presupuestos/GuardarNuevoPresupuesto', 'Presupuestos@guardar_nuevo_presupuesto');
Route::post('/Presupuestos/GuardarDetallePresupuesto', 'Presupuestos@guardar_nuevo_detalle_presupuesto');

Route::get('/Presupuestos/ListadoActivos','Presupuestos@lista_presupuestos_activos');
Route::post('/Presupuestos/VerDetalle', 'Presupuestos@ver_detalle_presupuesto');

Route::post('/Presupuestos/EliminarLineaDetalle', 'Presupuestos@eliminar_linea_detalle');

Route::get('/Presupuestos/VerDetalle', 'Presupuestos@ver_detalle_presupuesto_interno');

Route::post('/Presupuestos/Cerrar', 'Presupuestos@cerrar_presupuesto');
Route::post('/Presupuestos/Aprobar', 'Presupuestos@aprobar_presupuesto');
Route::post('/Presupuestos/ReAbrir', 'Presupuestos@reabrir_presupuesto');



Route::get('/Pagos/Registrar','Pagos@lista_presupuestos_para_pagos');
Route::get('/Pagos/Archivo','Pagos@lista_presupuestos_archivo_pagos');


Route::group(['middleware' => 'auth'], function () {

});
