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
                                <div class="form-group col-md-6">
                                    <label>Sub-Cuenta</label>
                                    <input type="number" name="sub_account" id="input-monto" class="form-control" min="0.1" step="0.1">
                                    <input type="hidden" name="element_id" class="form-control" value="{{$element_id}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Division</label>
                                    <input type="number" name="division" id="input-monto" class="form-control" min="0.1" step="0.1">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Sub-Division</label>
                                    <input type="number" name="sub_division" id="input-monto" class="form-control" min="0.1" step="0.1">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Nombre de Cuenta</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Tipo</label>
                                    <select name="tipo" class="form-control select2">
                                        <option value="A">Activo</option>
                                        <option value="P">Pasivo-Patrimonio</option>
                                        <option value="G">Gastos</option>
                                        <option value="I">Ingresos</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Grupo</label>
                                    <select name="grupo" class="form-control select2">
                                        <option value="1">Balance</option>
                                        <option value="2">E. G. y P Naturaleza</option>
                                        <option value="3">E. G. y P Funcion</option>
                                    </select>
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
