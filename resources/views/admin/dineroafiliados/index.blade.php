@extends('voyager::master')

@section('page_title', 'Aportes')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-dollar"></i> Aportes
        </h1>
        {{-- <a href="{{ route('pagos.create') }}" class="btn btn-success btn-add-new"> --}}
            <a href="{{route('dineroafiliados.create')}}" class="btn btn-success btn-add-new">

            <i class="voyager-plus"></i> <span>Crear</span>
        </a>
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
                                    <input type="search" name="search" class="form-control" placeholder="Buscar" name="s" value="" style="border: transparent !important">
                                    <span class="input-group-btn">
                                        <button class="btn btn-info btn-lg" type="submit">
                                            <i class="voyager-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive text-center">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Afiliado</th>
                                        <th class="text-center">Litros</th>
                                        <th class="text-center">Precio Lt.</th>
                                        <th class="text-center">Subtotal Leche</th>
                                        <th class="text-center">Subtotal Cobro</th>
                                        <th class="text-center">Total a Pagar</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dineroafiliados as $item)
                                    <tr>
                                        <td>
                                            {{ $item->afiliado->nombre_completo }} <br>
                                            <b><small>{{ $item->afiliado->rau ?? $item->afiliado->nit }}</small></b>
                                        </td>
                                        <td>{{ $item->litros }}</td>
                                        <td>{{ $item->precio_unitario}}</td>
                                        <td>{{ $item->total_leche }}</td>
                                        <td>{{ $item->total_cobro }}</td>
                                        <td>{{ $item->total_a_pagar}}</td>
                                        <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small> </td>
                                        <td class="no-sort no-click bread-actions text-right">
                                            {{-- <a href="#" title="Ver" class="btn btn-sm btn-warning view">
                                                <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                            </a> --}}
                                            <button title="Imprimir" onclick="generar_recibo({{ $item->id }})" class="btn btn-sm btn-primary edit">
                                                <i class="voyager-polaroid"></i> <span class="hidden-xs hidden-sm">Imprimir</span>
                                            </button>
                                            {{-- <a href="#" title="Borrar" onclick="borrar({{ $item->id }})" class="btn btn-sm btn-danger delete" data-id="{{ $item->id }}" >
                                                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar</span>
                                            </a> --}}
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
        </div>
    </div>

    {{-- Imprimir --}}
    <form id="form-print" action="{{ url('admin/recibo/transaccion') }}" method="post" target="_blank">
        @csrf
        <input type="hidden" name="id">
    </form>
@stop

@section('javascript')
    <script>
        function generar_recibo(id){
            $('#form-print input[name="id"]').val(id);
            $('#form-print').submit();
        }
        $(document).ready(function(){
            
        });
    </script>
@stop