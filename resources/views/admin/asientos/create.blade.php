@extends('voyager::master')

@section('page_title', 'Agregar asiento')

@if(auth()->user()->hasPermission('browse_aporteafiliado'))

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-dollar"></i> Agregar Asiento Contable
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <form id="form-store" action="{{ route('asientos.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Tipo</label>
                                    <select name="tipo" class="form-control" required>
                                        <option value="libro diario">Libro Diario</option>
                                        <option value="libro compra">Libro Compra</option>
                                        <option value="libro venta">Libro Venta</option>
                                    </select>
                                    @error('afiliado_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Mes</label>
                                    <select name="mes" class="form-control select2" required>
                                        <option value="1">ENERO</option>
                                        <option value="2">FEBRERO</option>
                                        <option value="3">MARZO</option>
                                        <option value="4">ABRIL</option>
                                        <option value="5">MAYO</option>
                                        <option value="6">JUNIO</option>
                                        <option value="7">JULIO</option>
                                        <option value="8">AGOSTO</option>
                                        <option value="9">SEPTIEMBRE</option>
                                        <option value="10">OCTUBRE</option>
                                        <option value="11">NOVIEMBRE</option>
                                        <option value="12">DICIEMBRE</option>
                                    </select>
                                    @error('aporte_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Fecha-Emision</label>
                                    <input type="date" name="fecha_emision" class="form-control" required>
                                    @error('fecha_emision')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-1">
                                    <label>F. V o P</label>
                                    <input type="text" name="fv_op" class="form-control">
                                    @error('fv_op')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-7">
                                    <label>Tipo de Documento</label>
                                    <select name="typedocument" class="form-control select2" required>
                                        <option value="">Seleccione el tipo de documento</option>
                                        @foreach(\App\Models\TypeDocument::pluck('name') as $doc)
                                                <option value="{{ $doc }}">{{ $doc }} </option>
                                        @endforeach
                                    </select>
                                    @error('typedocument')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Serie:</label>
                                    <input type="text" name="serie" class="form-control">
                                    @error('serie')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Nro. Doc.</label>
                                    <input type="text" name="nro_doc" class="form-control">
                                    @error('nro_doc')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2">
                                    <label>T Cambio.</label>
                                    <input type="text" name="tipo_cambio" class="form-control">
                                    @error('tipo_cambio')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Vouncher:</label>
                                    <select name="vouncher" class="form-control select2" required>
                                        <option value="" selected>Seleccione el vouncher</option>
                                        <option value="00">Apertura</option>
                                        <option value="01">Ventasas</option>
                                        <option value="02">Compras</option>
                                        <option value="03">Ingresos</option>
                                        <option value="04">Egresos</option>
                                        <option value="05">Diario</option>
                                    </select>
                                    @error('vouncher')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Nro. Vouncher.</label>
                                    <input type="text" name="nro_vouncher" class="form-control">
                                    @error('nro_vouncher')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="margin-top:-30px">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <h4 class="text-center">Detalle de Asientos</h4>
                            <div class="clearfix"></div>
                            <hr style="margin-top:0px">
                            <div class="col-md-12">
                                <div class="tab-content">
                                    <div id="tab1" class="tab-pane fade in  active ">
                                        <div id="detalle_venta">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="margin-top: -10px">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="return" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">Permanecer aquí</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-submit">Guardar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
     {{-- Modal de detalle de producto --}}
     <div class="modal modal-primary fade" tabindex="-1" id="modal-info_producto" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="voyager-harddrive"></i> Detalle de cuentas</h4>
                </div>
                <div class="modal-body" id="info_producto"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right" id="btn-cancel-map" data-dismiss="modal">cerrar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('javascript')
    <script src="{{ url('plugins/formatSelect2.js') }}"></script>
    <script>
          // cargar vista de detalle de compra según tipo
          $(document).ready(function(){
                $('[data-toggle="popover"]').popover();
                $('[data-toggle="tooltip"]').tooltip();
                // obtener datos de proveedor
                $('#input-nit').change(function(){
                    let nit = $(this).val();
                    if(nit!=''){
                        $.ajax({
                            url: `{{url('admin/proveedores/get_proveedor/${nit}')}}`,
                            type: 'get',
                            success: function(data){
                                if(data){
                                    $('#form input[name="razon_social"]').val(data);
                                    toastr.info('Proveedor seleccionado.', 'Información');
                                }
                            },
                            error: function(){
                                console.log('error');
                            }
                        });
                    }
                });

                $('#btn-enviar').click(function(){
                    let con_factura = $(this).prop('checked');
                    if(con_factura){
                        $('#confirm_modal').modal('hide');
                        let factura = $('#input-nro_factura').val();
                        let nit = $('#input-nit').val();
                        let nombre = $('#input-razon_social').val();
                        if(factura==''){
                            toastr.error('Debe ingresar un número de factura para realizar la venta.', 'Error');
                        }
                        if(nit==''){
                            toastr.error('Debe ingresar un NIT para realizar la venta.', 'Error');
                        }
                        if(nombre==''){
                            toastr.error('Debe ingresar la razón social para realizar la venta.', 'Error');
                        }
                    }
                });
            });

            cargar_detalle('productos')
            function cargar_detalle(tipo){
                $('#detalle_venta').html('<br><h4 class="text-center">Cargando...</h4><br>');
                $.ajax({
                    url: `{{url('admin/compras/crear')}}/`+tipo,
                    type: 'get',
                    success: function(data){
                        $('#detalle_venta').html(data);
                    },
                    error: function(){
                        console.log('error');
                    }
                });
            }

            function producto_info(id){
                $('#modal-info_producto').modal();
                $('#info_producto').html('<br><h4 class="text-center">Cargando...</h4>');
                $.get('{{url("admin/productos/ver/informacion")}}/'+id, function(data){
                    $('#info_producto').html(data);
                });
            }
    </script>
@stop

@else
    @section('content')
        @include('layouts.error')
    @endsection
@endif
