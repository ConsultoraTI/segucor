@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Lista de Presupuestos Activos
@endsection
@section('contentheader_title')
    Lista de Presupuestos Activos
@endsection
@section('contentheader_description')
    / Lista de Gestión
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
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                            @foreach($listado as $listado)
                                <tr>
                                    <td>{{ $listado -> idPresupuesto }}</td>
                                    <td>{{ date("d/M/Y H:i:s",strtotime($listado -> fecCreaPresup))  }}</td>
                                    <td>{{ $listado -> rsocCliente }}</td>
                                    <td>{{ $listado -> telCli }} - {{ $listado -> mailCli }}</td>
                                    <td><center>{{ $listado -> estadoPresup }}</center></td>
                                    <td>
                                        <center>
                                            <form action="/Presupuestos/VerDetalle" method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="idPresup"
                                                       value="{{ $listado -> idPresupuesto }}">
                                                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-laptop"></i>
                                                    Ver Detalle
                                                </button>
                                            </form>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
