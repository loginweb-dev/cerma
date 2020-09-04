@extends('voyager::master')

@section('page_title', 'Cobros')

@if(auth()->user()->hasPermission('browse_aporteafiliado'))

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-dollar"></i> Cobros
        </h1>
        <a href="{{ route('aporteafiliado.create') }}" class="btn btn-success btn-add-new">
            <i class="voyager-plus"></i> <span>Crear</span>
        </a>
    </div>
@stop

@section('content')
    @can('browse', app('App\AporteAfiliado'))
        <h1>si</h1>
    @endcan
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
                                        <th>Afiliado</th>
                                        <th>Aporte</th>
                                        <th>Monto</th>
                                        <th>Fecha</th>
                                        <th>Observaciones</th>
                                        {{-- <th class="text-right">Acciones</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cobros as $item)
                                    <tr>
                                        <td>
                                            {{ $item->afiliado->nombre_completo }} <br>
                                            <b><small>{{ $item->afiliado->rau ?? $item->afiliado->nit }}</small></b>
                                        </td>
                                        <td>{{ $item->aporte->nombre }}</td>
                                        <td>Bs. {{ $item->monto }}</td>
                                        <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small> </td>
                                        <td>{{ $item->observacion }}</td>
                                        {{-- <td class="no-sort no-click bread-actions text-right">
                                            <a href="#" title="Ver" class="btn btn-sm btn-warning view">
                                                <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                            </a>
                                            <a href="http://127.0.0.1:8000/admin/cuentas/1/edit" title="Editar" class="btn btn-sm btn-primary edit">
                                                <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                                            </a>
                                            <a href="javascript:;" title="Borrar" class="btn btn-sm btn-danger delete" data-id="{{ $item->id }}" >
                                                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar</span>
                                            </a>
                                        </td> --}}
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

@stop

@section('css')
    
@stop

@section('javascript')
    <script>
        $(document).ready(function(){
            
        });
    </script>
@stop

@else
    @section('content')
        @include('layouts.error')
    @endsection
@endif
