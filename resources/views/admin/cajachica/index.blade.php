@extends('voyager::master')

@section('page_title', 'Pagos')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-categories"></i> Caja Chica
        </h1>
        <a href="{{ route('cajachica.create') }}" class="btn btn-success btn-add-new">
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
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Editor</th>
                                        <th>Monto</th>
                                        <th>Glosa</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($movimientos as $item)
                                        <tr>
                                            <td>
                                                @if ($item->tipo_movimiento=="1")
                                                    <b>Ingreso</b>
                                                @else
                                                    <b>Egreso</b>
                                                @endif
                                            </td>
                                            <td>
                                                {{$item->user->name}}
                                            </td>
                                            <td>
                                                {{ $item->monto }} Bs. 
                                            </td>
                                            <td>
                                                {{$item->glosa}}
                                            </td>

                                            <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }} <br> <small>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small> </td>
                                          
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

@section('javascript')
    
@stop