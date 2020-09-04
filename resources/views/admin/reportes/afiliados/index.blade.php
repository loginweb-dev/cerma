@extends('voyager::master')

@section('page_title', 'Historil de aportes')

{{-- @if(auth()->user()->hasPermission('browse_aporteafiliado')) --}}

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-people"></i> Historil de aportes
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <form id="form-generate" method="POST" action="{{ url('admin/reportes/afiliados/lista') }}" >
                            @csrf
                            <div class="form-group">
                                <label>Buscar afiliado</label>
                                <select name="afiliado_id" class="form-control" id="select-afiliado_id">
                                </select>
                            </div>
                            {{-- <button type="submit">ok</button> --}}
                        </form>
                        <div id="list-data"></div>
                    </div>
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
        $(document).ready(function(){

            // Inicializar select2 personalizado
            $('#select-afiliado_id').select2({
                placeholder: '<i class="fa fa-search"></i> Buscar cliente...',
                escapeMarkup : function(markup) {
                    return markup;
                },
                language: {
                    inputTooShort: function (data) {
                        return `Por favor ingrese ${data.minimum - data.input.length} o más caracteres`;
                    },
                    noResults: function () {
                        return `<i class="far fa-frown"></i> No hay resultados encontrados`;
                    }
                },
                quietMillis: 250,
                minimumInputLength: 4,
                ajax: {
                    url: function (params) {
                        return `../../admin/afiliados/get/${escape(params.term)}`;
                    },        
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                templateResult: formatResultAfiliados,
                templateSelection: (opt) => opt.nombre_completo
            });

            // Asignar monto según el aporte seleccionado
            $('#select-afiliado_id').change(function(){
                $.post("{{ url('admin/reportes/afiliados/lista') }}", $('#form-generate').serialize(), function(res){
                    $('#list-data').html(res);
                });
            });
        });
    </script>
@stop

{{-- @else
    @section('content')
        @include('layouts.error')
    @endsection
@endif --}}