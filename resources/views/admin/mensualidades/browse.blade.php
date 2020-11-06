@extends('voyager::master')

@section('page_title', 'Mensualidades')

@if(auth()->user()->hasPermission('browse_aporteafiliado'))

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-calendar"></i> Mensualidades
        </h1>
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form id="form-search" class="form-search">
                            <div id="search-input">
                                <div class="input-group col-md-12">
                                    <input type="search" name="search" class="form-control" placeholder="Buscar" name="s" value="{{ $search }}" style="border: transparent !important">
                                    <span class="input-group-btn">
                                        <button class="btn btn-info btn-lg" type="submit">
                                            <i class="voyager-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Imagen</th>
                                        <th>Afiliado</th>
                                        <th>fecha de afiliacion</th>
                                        <th>Pagado hasta</th>
                                        <th class="text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($mensualidades as $item)
                                    @php
                                        $foto = $item->foto ?? 'users/default.png'
                                    @endphp
                                    <tr>
                                        <td width="100px">
                                            <img src="{{ url('storage/'.$foto) }}" alt="{{ $item->nombre_completo }}" width="80px">
                                        </td>
                                        <td>
                                            {{ $item->nombre_completo }} <br>
                                            <b><small>{{ $item->rau ?? $item->nit }}</small></b>
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($item->fecha_afiliacion)) }} <br> <small>{{ \Carbon\Carbon::parse($item->fecha_afiliacion)->diffForHumans() }}</small> </td>
                                        @if ($item->fecha_ultimo_pago)
                                        <td>{{ date('d-m-Y', strtotime($item->fecha_ultimo_pago)) }} <br> <small>{{ \Carbon\Carbon::parse($item->fecha_ultimo_pago)->diffForHumans() }}</small> </td>
                                        @else
                                        <td><i>Ningún pago</i></td>
                                        @endif
                                        <td class="no-sort no-click bread-actions text-right">
                                            <a href="#" title="Ver" class="btn btn-sm btn-primary view">
                                                <i class="voyager-list"></i> <span class="hidden-xs hidden-sm">Historial</span>
                                            </a>
                                            <a href="#" title="Ver" class="btn btn-sm btn-success btn-pagar view" data-id="{{ $item->id }}" data-nombre="{{ $item->nombre_completo }}" data-toggle="modal" data-target="#modal-pagar">
                                                <i class="voyager-dollar"></i> <span class="hidden-xs hidden-sm">Pagar</span>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No hay registros</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4" style="overflow-x:auto">
                    @if(count($mensualidades)>0)
                        <p class="text-muted">Mostrando del {{ $mensualidades->firstItem() }} al {{ $mensualidades->lastItem() }} de {{ $mensualidades->total() }} registros.</p>
                    @endif
                </div>
                <div class="col-md-8" style="overflow-x:auto">
                    <nav class="text-right">
                        {{ $mensualidades->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <form id="form-guardar" action="{{ route('mensualidades.store') }}" method="POST">
        <div class="modal fade" tabindex="-1" tabindex="-1" id="modal-pagar" role="dialog">
            <div class="modal-dialog modal-primary" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            <i class="voyager-dollar"></i> Realizar pago de mensualidad
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                        </h4>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="afiliado_id">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <label>Varias mensualidades </label>
                                <input type="checkbox" id="check-tipo" name="intervalo" data-toggle="toggle" data-onstyle="success" data-on="Si" data-off="No" width="100">
                            </div>
                        </div>
                        <div class="alert alert-info">
                            <strong>Información</strong>
                            <p>Si se va a pagar la primera quincena seleccionar el 1ro del mes, si es la segunda seleccionar el 15 del mes.</p>
                        </div>
                        <div class="form-group">
                            <label>Fecha</label>
                            <input type="date" name="periodo" class="form-control" required>
                        </div>
                        <div class="form-group" id="form-periodo_fin" style="display: none">
                            <label>Hasta</label>
                            <input type="date" name="periodo_fin" class="form-control">
                        </div>
                        @php
                            $quincena = App\Aporte::find(1);
                            $monto_quincena = $quincena ? $quincena->monto : 20;
                        @endphp
                        <div class="form-group">
                            <label>Costo de quincena</label>
                            <input type="number" min="0" step="1" name="monto" value="{{ $monto_quincena }}" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Observaciones</label>
                            <textarea name="observacion" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary btn-guardar">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('css')
    
@stop

@section('javascript')
    <script>
        $(document).ready(function(){

            $('.btn-pagar').click(function(){
                let id = $(this).data('id');
                let nombre = $(this).data('nombre');
                $('#modal-pagar input[name="afiliado_id"]').val(id);
                $('#modal-pagar textarea[name="observacion"]').val(`Pago de quincena de ${nombre}`);
            });

            // Activar el pago de varias mensualidades
            $('#check-tipo').change(function() {
                if($(this).prop('checked')){
                    $('#form-periodo_fin').fadeIn();
                    $('#form-periodo_fin input[name="periodo_fin"]').attr('required', 'required')
                }else{
                    $('#form-periodo_fin').fadeOut();
                    $('#form-periodo_fin input[name="periodo_fin"]').val('')
                    $('#form-periodo_fin input[name="periodo_fin"]').removeAttr('required')
                }
            });

            $('#form-guardar').submit(function(){
                $('.btn-guardar').attr('disabled', 'disabled');
            });

        });
    </script>
@stop

@else
    @section('content')
        @include('layouts.error')
    @endsection
@endif
