@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Lista de Presupuestos a Pago
@endsection
@section('contentheader_title')
    Lista de Presupuestos a Pago
@endsection
@section('contentheader_description')
    / Lista de Gestión Pagos
@endsection
@section('main-content')
    <div class="col-md-12">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Presupuestos</h3>

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
                                <th>ID - Folio</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Fono - Correo</th>
                                <th>Pagado / Total</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
