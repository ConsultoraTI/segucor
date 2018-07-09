<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DateTime;
use DB;

class Presupuestos extends Controller
{

    public function crear()
    {
        return view('back_end.presupuestos.crear');
    }

    public function guardar_nuevo_presupuesto(Request $request)
    {
        $id_presupuesto = DB::table('presupuestos')->insertGetId([
            'folioInterno' => $request->input('FolioInt'),
            'fecCreaPresup' => new datetime(),
            'rutCliente' => $request->input('RutCli'),
            'rsocCliente' => $request->input('RSocCli'),
            'giroCliente' => $request->input('GiroCli'),
            'telCli' => $request->input('TelCli'),
            'mailCli' => $request->input('MailCli'),
            'OrdenCompra' => $request->input('OrdenCompra'),
            'obsCli' => $request->input('ObsCliPre'),
            'estadoPresup' => '1',
            'users_id' => Auth::user()->id,
        ]);

        DB::table('logs_publicos')->insert([
            'detalleLog' => 'Ha creado un nuevo presupuesto, cuyo folio es: ',
            'users_id' => Auth::user()->id,
            'presupuestos_idPresupuesto' => $id_presupuesto
        ]);

        return redirect('/Presupuestos/ListadoActivos');
    }

    public function lista_presupuestos_activos()
    {

        $listado = DB::table('presupuestos')
            ->get();

        return view('back_end.presupuestos.listado_presupuestos_activos', compact('listado'));
    }

    public function ver_detalle_presupuesto(Request $request)
    {
        $id = $request->input('idPresup');
        $id_presupuesto = $id;

        $presup = DB::table('presupuestos')
            ->where('idPresupuesto', $id)
            ->first();

        $detalle_presupuesto = DB::table('detallepresupuestos')
            ->where([
                ['presupuestos_idPresupuesto', $id_presupuesto],
                ['estadoDetProd', 1]
            ])
            ->get();

        $subtotal = DB::table('detallepresupuestos')
            ->where([
                ['presupuestos_idPresupuesto', $id_presupuesto],
                ['estadoDetProd', 1]
            ])
            ->sum('subtotalProd');

        return view('back_end.presupuestos.detalle_presupuesto',
            compact('id', 'id_presupuesto', 'detalle_presupuesto', 'subtotal', 'presup'));
    }

    public function ver_detalle_presupuesto_interno()
    {
        $id_presupuesto = $_GET['id'];
        $id = $id_presupuesto;

        $presup = DB::table('presupuestos')
            ->where('idPresupuesto', $id)
            ->first();

        $detalle_presupuesto = DB::table('detallepresupuestos')
            ->where([
                ['presupuestos_idPresupuesto', $id_presupuesto],
                ['estadoDetProd', 1]
            ])
            ->get();

        $subtotal = DB::table('detallepresupuestos')
            ->where([
                ['presupuestos_idPresupuesto', $id_presupuesto],
                ['estadoDetProd', 1]
            ])
            ->sum('subtotalProd');

        return view('back_end.presupuestos.detalle_presupuesto',
            compact('id', 'id_presupuesto', 'detalle_presupuesto', 'subtotal', 'presup'));
    }

    public function guardar_nuevo_detalle_presupuesto(Request $request)
    {

        $id__detalle_presupuesto = DB::table('detallepresupuestos')->insertGetId([
            'nombreProd' => $request->input('Descripcion'),
            'cantidadProd' => $request->input('Cantidad'),
            'unidMedProd' => $request->input('Unidad'),
            'valUnitProd' => $request->input('ValorUnit'),
            'subtotalProd' => $request->input('ValorUnit') * $request->input('Cantidad'),
            'estadoDetProd' => 1,
            'presupuestos_idPresupuesto' => $request->input('id'),
        ]);

        $id = $request->input('id');

        return redirect()->action(
            'Presupuestos@ver_detalle_presupuesto_interno', ['id' => $id]
        );

    }

    public function eliminar_linea_detalle(Request $request)
    {

        DB::table('detallepresupuestos')
            ->where('idDetallePresup', $request->input('idLinDet'))
            ->update(['estadoDetProd' => 2]);

        $id = $request->input('id');

        return redirect()->action(
            'Presupuestos@ver_detalle_presupuesto_interno', ['id' => $id]
        );

    }

    public function cerrar_presupuesto(Request $request)
    {

        DB::table('presupuestos')
            ->where('idPresupuesto', $request->input('id'))
            ->update(['estadoPresup' => 2]);

        $id = $request->input('id');

        return redirect()->action(
            'Presupuestos@ver_detalle_presupuesto_interno', ['id' => $id]
        );

    }

    public function aprobar_presupuesto(Request $request)
    {
        DB::table('presupuestos')
            ->where('idPresupuesto', $request->input('id'))
            ->update(['estadoPresup' => 3]);

        $id = $request->input('id');

        return redirect()->action(
            'Presupuestos@ver_detalle_presupuesto_interno', ['id' => $id]
        );
    }

    public function reabrir_presupuesto(Request $request)
    {

        DB::table('presupuestos')
            ->where('idPresupuesto', $request->input('id'))
            ->update(['estadoPresup' => 1]);

        $id = $request->input('id');

        return redirect()->action(
            'Presupuestos@ver_detalle_presupuesto_interno', ['id' => $id]
        );
    }

}
