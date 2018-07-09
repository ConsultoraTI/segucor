@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Detalle Presupuesto
@endsection
@section('contentheader_title')
    Detalle Presupuesto
@endsection
@section('contentheader_description')
    / Detalle del Presupuesto
@endsection
@section('main-content')
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-dollar"></i>
                <h3 class="box-title">Detalle del Presupuesto</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form role="form" action="/Presupuestos/GuardarDetallePresupuesto" method="POST"
                      class="form-horizontal">
                    <!-- text input -->
                    <div class="form-group">
                        <div class="col-md-2">
                            <label>Folio Presupuesto:</label>
                            <input type="text" name="id" class="form-control" value="{{ $id }}" readonly>
                        </div>

                        <div class="col-md-2">
                            <label>Rut Cliente:</label>
                            <input type="text" name="RutCli" class="form-control"
                                   placeholder="{{ $presup->rutCliente }}" readonly>
                        </div>

                        <div class="col-md-4">
                            <label>Razón Social:</label>
                            <input type="text" name="RSocCli" class="form-control"
                                   placeholder="{{ $presup->rsocCliente }}" readonly>
                        </div>

                        <div class="col-md-2">
                            <label>N° OC:</label>
                            <input type="text" name="RSocCli" class="form-control"
                                   placeholder="{{ $presup->OrdenCompra }}" readonly>
                        </div>

                        <div class="col-md-2">
                            <label>Revisión N°:</label>
                            <input type="text" name="RSocCli" class="form-control" placeholder="1" readonly>
                        </div>
                    </div>
                </form>
                <hr>
                <center>
                    @if($presup->estadoPresup == 1)
                        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal"
                                data-target="#AgregaDetalle">
                            Agregar Línea de Detalle
                        </button>
                    @elseif($presup->estadoPresup == 2)
                        <button type="button" class="btn btn-warning btn-xs" data-toggle="modal"
                                data-target="#AgregaDetalle" disabled>
                            Agregar Línea de Detalle
                        </button>
                    @endif

                    @if($presup->estadoPresup == 1)
                        <button type="button" class="btn btn-success btn-xs" data-toggle="modal"
                                data-target="#CierraPresupuesto">
                            Cerrar Presupuesto
                        </button>
                    @elseif($presup->estadoPresup == 2)
                        <button type="button" class="btn btn-success btn-xs" data-toggle="modal"
                                data-target="#CierraPresupuesto" disabled>
                            Cerrar Presupuesto
                        </button>
                    @endif

                    @if($presup->estadoPresup == 1)
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                                data-target="#ApruebaPresupuesto" disabled>
                            Aprobar Presupuesto
                        </button>
                    @elseif($presup->estadoPresup == 2)
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                                data-target="#ApruebaPresupuesto">
                            Aprobar Presupuesto
                        </button>

                        <button type="button" class="btn btn-success btn-xs" data-toggle="modal"
                                data-target="#ReApruebaPresupuesto">
                            Re-Abrir Presupuesto
                        </button>
                    @endif

                </center>
            </div>
            <!-- /.box-body -->
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Detalle del Presupuesto N° {{ $id }}</h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-file-excel-o"></i>
                                        Exportar a Excel
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>NUM</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Unidad</th>
                                <th>Valor Unit.</th>
                                <th>Subtotal</th>
                                <th>Acción</th>
                            </tr>
                            @foreach($detalle_presupuesto as $dt)
                                <tr>
                                    <td> -</td>
                                    <td>{{ $dt -> nombreProd }}</td>
                                    <td>{{ $dt -> cantidadProd }}</td>
                                    <td>{{ $dt -> unidMedProd }}</td>
                                    <td>$ {{ number_format($dt->valUnitProd, 0, '.', '.') }}</td>
                                    <td>$ {{number_format($dt -> subtotalProd, 0, '.', '.')  }}</td>
                                    <td>@if($presup->estadoPresup == 1)
                                            <form action="/Presupuestos/EliminarLineaDetalle" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="id" value="{{$id}}">
                                                <input type="hidden" name="idLinDet"
                                                       value="{{ $dt -> idDetallePresup }}">
                                                <button type="submit" class="btn btn-danger btn-xs"><i
                                                        class="fa fa-close"></i>
                                                    Eliminar
                                                </button>
                                            </form>
                                        @else
                                            <button type="submit" class="btn btn-danger btn-xs" disabled><i
                                                    class="fa fa-close"></i>
                                                Eliminar
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Detalle del Presupuesto</h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>Subtotal</th>
                                <th>Neto</th>
                                <th>IVA</th>
                                <th>Total</th>
                            </tr>
                            <tr>
                                <td>$ {{ number_format($subtotal, 0, '.', '.') }}</td>
                                <td>$ {{ number_format($subtotal, 0, '.', '.') }}</td>
                                <td>$ {{ number_format($subtotal*0.19, 0, '.', '.') }}</td>
                                <td>$ {{ number_format($subtotal*1.19, 0, '.', '.') }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <button type="button" class="btn btn-primary">
            <i class="fa fa-print"></i> Imprimir Presupuesto
        </button>

    </div>


    <div class="modal" id="AgregaDetalle" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Línea de Detalle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" action="/Presupuestos/GuardarDetallePresupuesto" method="POST"
                          class="form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $id_presupuesto }}">
                        <!-- text input -->
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Descripción:</label>
                                <input type="text" name="Descripcion" class="form-control"
                                       placeholder="Descripción del Producto" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>Cantidad:</label>
                                <input type="number" name="Cantidad" min="1" class="form-control" placeholder="Cantidad"
                                       required>
                            </div>

                            <div class="col-md-4">
                                <label>Unidad Medida:</label>
                                <input type="text" name="Unidad" class="form-control" placeholder="C/U" required>
                            </div>

                            <div class="col-md-4">
                                <label>Valor Unitario:</label>
                                <input type="number" name="ValorUnit" min="1" class="form-control" placeholder="1200"
                                       required>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                            <button id="btn" class="btn btn-success pull-right">Agregar Detalle</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="CierraPresupuesto" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cerrar Presupuesto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" action="/Presupuestos/Cerrar" method="POST"
                          class="form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $id_presupuesto }}">
                        <center>
                            <button id="btn" class="btn btn-warning">Cerrar Presupuesto</button>
                        </center>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="ApruebaPresupuesto" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Aprueba Presupuesto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" action="/Presupuestos/Aprobar" method="POST"
                          class="form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $id_presupuesto }}">
                        <center>
                            <button id="btn" class="btn btn-primary">Aprobar Presupuesto</button>
                        </center>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="ReApruebaPresupuesto" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Re Abrir Presupuesto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" action="/Presupuestos/ReAbrir" method="POST"
                          class="form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $id_presupuesto }}">
                        <center>
                            <button id="btn" class="btn btn-success">Re Abrir Presupuesto</button>
                        </center>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

@endsection
