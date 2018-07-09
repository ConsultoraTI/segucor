@extends('adminlte::layouts.app')
@section('htmlheader_title')
    Nuevo Presupuesto
@endsection
@section('contentheader_title')
    Nuevo Presupuesto
@endsection
@section('contentheader_description')
    / Crear Presupuesto
@endsection
@section('main-content')
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <i class="fa fa-dollar"></i>
                <h3 class="box-title">Crear Presupuesto</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form role="form" action="/Presupuestos/GuardarNuevoPresupuesto" method="POST" class="form-horizontal">
                    <!-- text input -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <div class="col-md-2">
                            <label>Folio Interno: (Papel)</label>
                            <input type="text" name="FolioInt" class="form-control" placeholder="0000">
                        </div>

                        <div class="col-md-2">
                            <label>Rut Cliente:</label>
                            <input type="text" name="RutCli" class="form-control" placeholder="00.000.000-0" required>
                        </div>

                        <div class="col-md-6">
                            <label>Razón Social:</label>
                            <input type="text" name="RSocCli" class="form-control" placeholder="Los Muermos SpA." required>
                        </div>

                        <div class="col-md-2">
                            <label>N° Orden Compra:</label>
                            <input type="number" name="OrdenCompra" class="form-control" min="0" placeholder="0000">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-5">
                            <label>Giro:</label>
                            <input type="text" name="GiroCli" class="form-control" placeholder="Servicios Generales" required>
                        </div>

                        <div class="col-md-3">
                            <label>Teléfono:</label>
                            <input type="number" name="TelCli" class="form-control" min="0" placeholder="900000000" required>
                        </div>

                        <div class="col-md-4">
                            <label>Correo Electrónico:</label>
                            <input type="email" name="MailCli" class="form-control"
                                   placeholder="contacto@losmuermos.cl" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-5">
                            <label>Observaciones Presupuesto:</label>
                            <textarea class="form-control" name="ObsCliPre" rows="3"
                                      placeholder="Observaciones Generales de la Propuesta">
                            </textarea>
                        </div>

                        <div class="col-md-3">
                            <label>Creado por:</label>
                            <input type="text" name="CreadoPor" class="form-control" value="{{Auth::user()->name}}"
                                   readonly>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="reset" class="btn btn-default">Limpiar Formulario</button>
                        <button id="btn" class="btn btn-primary pull-right">Crear Nuevo Presupuesto</button>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
@endsection
