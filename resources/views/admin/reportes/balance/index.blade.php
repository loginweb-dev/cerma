@extends('voyager::master')

@section('page_title', 'Generar Libro Mayor')

{{-- @if(auth()->user()->hasPermission('browse_aporteafiliado')) --}}

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-documentation"></i> Balance General
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="row">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#list">Seleccione Fecha</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="list" class="tab-pane fade in active">
                                    <form id="form-generate" name="form" method="POST" action="{{ url('admin/reports/balancegnral/list') }}" class="form-inline">
                                        @csrf
                                        <div class="form-group">
                                            <input type="date" name="inicio" class="form-control" value="{{ date('Y-m-d') }}">
                                             -hasta-
                                            <input type="date" name="fin" class="form-control" value="{{ date('Y-m-d') }}">
                                             <input type="hidden" name="printf" class="printf">
                                            <button type="submit" class="btn btn-primary">Generar <i class="voyager-settings"></i></button>
                                            <button id="printf" type="button" class="btn btn-success">Imprimir <i class="voyager-polaroid"></i></button>
                                        </div>
                                    </form>
                                    <div id="list-generate" style="margin-top: 20px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
<script>
    $(document).ready(function(){
        $('#form-generate').on('submit', function(e){
            $(".printf").val('noimprimir');
            $('#form-generate').removeAttr('target')
            e.preventDefault();
            $.post($(this).attr('action'), $(this).serialize(), function(res){
                $('#list-generate').html(res);
            });
        });
    });
    $("#printf").click(function(){
        $('#form-generate').attr('target','_blank')
       $(".printf").val('imprimir');
       document.form.submit();
    });
</script>
@stop

{{-- @else
    @section('content')
        @include('layouts.error')
    @endsection
@endif --}}
