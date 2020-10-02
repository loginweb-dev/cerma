@extends('voyager::master')

@section('page_title', 'Agregar cobro')

@if(auth()->user()->hasPermission('browse_aporteafiliado'))

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-dollar"></i> Agregar Cuenta
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <form id="form-store" action="{{route('store_account')}}" method="POST">
                @csrf
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Codigo</label>
                                    <input type="number" name="code" class="form-control">
                                    <input type="hidden" name="cuenta_id" class="form-control" value="{{$element_id}}">
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Nombre de Cuenta</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="submit" class="btn btn-primary btn-submit">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: -10px">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th colspan="2" class="text-center h3">Sub Cuentas</th>
                                            </tr>
                                            <tr>
                                                <th>Codigo</th>
                                                <th>Nombre</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($cuenta->detailaccounts as $item)
                                                <tr>
                                                    <td>{{ $item->code }}</td>
                                                    <td>{{ $item->name }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No hay datos registrados</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')

@stop

@section('javascript')
    <script src="{{ url('plugins/formatSelect2.js') }}"></script>
    <script>


    </script>
@stop

@else
    @section('content')
        @include('layouts.error')
    @endsection
@endif
