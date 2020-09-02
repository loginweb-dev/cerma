@extends('voyager::master')

@section('page_title', 'Agregar cobro')

@if(auth()->user()->hasPermission('browse_aporteafiliado'))

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-dollar"></i> Agregar cobro
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <form id="form-store" action="{{ route('aporteafiliado.store') }}" method="POST">
                @csrf
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Afiliado</label>
                                    <select name="afiliado_id" class="form-control" id="select-afiliado_id" required>
                                    </select>
                                    @error('afiliado_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Aporte</label>
                                    <select name="aporte_id" class="form-control select2" id="select-aporte_id" required>
                                        <option value="">Seleccione el aporte</option>
                                        @foreach ($aportes as $item)
                                        <option value="{{ $item->id }}" data-monto="{{ $item->monto }}">{{ $item->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('aporte_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Aporte</label>
                                    <input type="number" name="monto" id="input-monto" class="form-control" min="0.1" step="0.1" required>
                                    @error('monto')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Observación</label>
                                    <textarea name="observacion" class="form-control" rows="3"></textarea>
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
            $('#select-aporte_id').change(function(){
                let monto = $('#select-aporte_id option:selected').data('monto');
                $('#input-monto').val(monto);
            });
        });

        function formatResultAfiliados(option){
            // Si está cargando mostrar texto de carga
            if (option.loading) {
                return '<span class="text-center"><i class="fas fa-spinner fa-spin"></i> Buscando...</span>';
            }
            // Mostrar las opciones encontradas
            return $(`<span>
                            <div class="row">
                                <div class="col-sm-10" style="margin:0px">
                                    <b class="text-dark">${option.nombre_completo}</b><br>
                                    ${option.rau ? 'RAU: '+option.rau : 'CI: '+option.ci}
                                </div>
                            </div>
                    </span>`);
        }
    </script>
@stop

@else
    @section('content')
        @include('layouts.error')
    @endsection
@endif