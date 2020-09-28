@extends('voyager::master')

@section('page_title', 'Importar recepción de leche')

{{-- @if(auth()->user()->hasPermission('browse_aporteafiliado')) --}}

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-data"></i> Importar recepción de leche
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
                                <li class="active"><a data-toggle="tab" href="#list">Lista</a></li>
                                <li><a data-toggle="tab" href="#importar">Importar</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="list" class="tab-pane fade in active">
                                    <form id="form-generate" method="POST" action="{{ url('admin/importar/recepciones/list') }}" class="form-inline">
                                        @csrf
                                        <div class="form-group">
                                            <select name="mes" class="form-control" required>
                                                <option value="">Seleccione el mes</option>
                                                <option value="1">Enero</option>
                                                <option value="2">Febrero</option>
                                                <option value="3">Marzo</option>
                                                <option value="4">Abril</option>
                                                <option value="5">Mayo</option>
                                                <option value="6">Junio</option>
                                                <option value="7">Julio</option>
                                                <option value="8">Agosto</option>
                                                <option value="9">Septiembre</option>
                                                <option value="10">Octubre</option>
                                                <option value="11">Noviembre</option>
                                                <option value="12">Diciembre</option>
                                            </select>
                                            <input type="number" name="anio" step="1" value="{{ date('Y') }}" class="form-control">
                                            <button type="submit" class="btn btn-primary">Generar <i class="voyager-settings"></i></button>
                                        </div>
                                    </form>
                                    <div id="list-generate" style="margin-top: 20px"></div>
                                </div>
                                <div id="importar" class="tab-pane fade">
                                    <div class="form-group col-md-12">
                                        <form action="{{ url('admin/importar/recepciones/datos') }}" class='dropzone' >
                                            @csrf
                                            <div class="dz-default dz-message" data-dz-message="">
                                                <h3 class="text-muted">
                                                    Da click o arrastra un archivo<br>
                                                    <small>(Tamaño máximo 5MB, formatos admitidos .xls,.xlsx)</small>
                                                </h3>
                                            </div>
                                        </form>
                                    </div>
                                    <div id="list-data"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/dropzone/dropzone.css') }}">
@stop

@section('javascript')
    <script src="{{ asset('plugins/dropzone/dropzone.js') }}" type="text/javascript"></script>
    <script>
        Dropzone.autoDiscover = false;
        // Dropzone
        var myDropzone = new Dropzone(".dropzone",{ 
            maxFilesize: 5,  // 5 MB
            acceptedFiles: ".xls,.xlsx",
        });
        myDropzone.on("success", function(file, res) {
            if(res.data == 'success'){
                toastr.success('Datos importados correctamente.', 'Bien hecho!');
                console.log(res)
                getList();
            }else{
                toastr.error('Ocurrio un error al importar los datos.', 'Error!')
            }
        });
        $(document).ready(function(){
            getList();

            $('#form-generate').on('submit', function(e){
                e.preventDefault();
                $.post($(this).attr('action'), $(this).serialize(), function(res){
                    $('#list-generate').html(res);
                });
            });
        });

        function getList(){
            $.get("{{ url('admin/importar/recepciones/datos/view') }}", function(res){
                $('#list-data').html(res);
            });
        }
    </script>
@stop

{{-- @else
    @section('content')
        @include('layouts.error')
    @endsection
@endif --}}