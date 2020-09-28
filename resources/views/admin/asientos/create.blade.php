@extends('voyager::master')

@section('page_title', 'Agregar asiento')

@if(auth()->user()->hasPermission('browse_aporteafiliado'))

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-dollar"></i> Agregar Asiento Contable
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <form id="form-store" action="{{ route('asientos.store') }}" method="POST">
                @csrf
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Tipo</label>
                                    <select name="tipo" class="form-control" required>
                                        <option value="libro diario">Libro Diario</option>
                                        <option value="libro compra">Libro Compra</option>
                                        <option value="libro venta">Libro Venta</option>
                                    </select>
                                    @error('afiliado_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Mes</label>
                                    <select name="mes" class="form-control select2" required>
                                        <option value="1">ENERO</option>
                                        <option value="2">FEBRERO</option>
                                        <option value="3">MARZO</option>
                                        <option value="4">ABRIL</option>
                                        <option value="5">MAYO</option>
                                        <option value="6">JUNIO</option>
                                        <option value="7">JULIO</option>
                                        <option value="8">AGOSTO</option>
                                        <option value="9">SEPTIEMBRE</option>
                                        <option value="10">OCTUBRE</option>
                                        <option value="11">NOVIEMBRE</option>
                                        <option value="12">DICIEMBRE</option>
                                    </select>
                                    @error('aporte_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Fecha-Emision</label>
                                    <input type="date" name="fecha_emision" class="form-control" required>
                                    @error('fecha_emision')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-1">
                                    <label>F. V o P</label>
                                    <input type="text" name="fv_op" class="form-control">
                                    @error('fv_op')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-7">
                                    <label>Tipo de Documento</label>
                                    <select name="typedocument" class="form-control select2" required>
                                        <option value="">Seleccione el tipo de documento</option>
                                        @foreach(\App\Models\TypeDocument::pluck('name') as $doc)
                                                <option value="{{ $doc }}">{{ $doc }} </option>
                                        @endforeach
                                    </select>
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
            $('#select-aporte_id').change(function(){
                let monto = $('#select-aporte_id option:selected').data('monto');
                $('#input-monto').val(monto);
            });
        });
    </script>
@stop

@else
    @section('content')
        @include('layouts.error')
    @endsection
@endif
