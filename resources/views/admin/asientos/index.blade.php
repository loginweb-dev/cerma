@extends('voyager::master')

@section('page_title', 'Asientos')

@if(auth()->user()->hasPermission('browse_aporteafiliado'))

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-dollar"></i> Asientos Contables
        </h1>
        <a href="{{ route('asientos.create') }}" class="btn btn-success btn-add-new">
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
                                        <th>Usuario</th>
                                        <th>Fecha</th>
                                        <th>Glosa</th>
                                        <th class="text-right">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($asientos as $item)
                                    <tr>
                                        <td>
                                            {{ $item->user->name }} <br>
                                            <b><small>{{ $item->user->email }}</small></b>
                                        </td>
                                        <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small> </td>
                                        <td>{{ $item->glosa}}</td>
                                        <td class="no-sort no-click bread-actions text-right">
                                            {{-- <a href="#" title="Ver" class="btn btn-sm btn-warning view">
                                                <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                                            </a> --}}
                                            <button title="Imprimir" onclick="generar_recibo({{ $item->id }})" class="btn btn-sm btn-primary edit">
                                                <i class="voyager-polaroid"></i> <span class="hidden-xs hidden-sm">Imprimir</span>
                                            </button>
                                            <a href="#" title="Borrar" onclick="borrar({{ $item->id }})" class="btn btn-sm btn-danger delete" data-id="{{ $item->id }}" >
                                                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar</span>
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
        </div>
    </div>

    {{-- Imprimir --}}
    <form id="form-print" action="{{ url('admin/recibo/aportacion') }}" method="post" target="_blank">
        @csrf
        <input type="hidden" name="id">
    </form>

    {{-- Borrar --}}
    <div class="modal modal-danger fade" id="delete_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> ¿Estás seguro que quieres eliminar el registro?</h4>
                </div>
                <div class="modal-footer">
                    <form id="form-delete" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        @csrf
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Sí, ¡Bórralo!">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@stop

@section('css')

@stop

@section('javascript')
    <script>

    </script>
@stop

@else
    @section('content')
        @include('layouts.error')
    @endsection
@endif
