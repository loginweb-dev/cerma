@extends('voyager::master')

@section('page_title', 'Registrar pago')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-dollar"></i> Registrar Pago
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <form action="{{ route('pagos.store') }}" method="POST">
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
                                    <label>Pago</label>
                                    <select name="pago_id" class="form-control select2" id="select-pago_id" required>
                                        <option value="">Seleccione el Tipo de Pago</option>
                                        @foreach ($pago_option as $item)
                                        <option value="{{ $item->id }}" data-monto="{{ $item->monto }}">{{ $item->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('pago_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Pago</label>
                                    <input type="number" name="monto" id="input-monto" class="form-control" min="0.1" step="0.1" required>
                                    @error('monto')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Fecha</label>
                                    <input type="date" name="fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
                                    @error('fecha')
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
                            <button type="submit" class="btn btn-primary btn-submit" >Guardar</button>
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
            $('#select-pago_id').change(function(){
                let monto = $('#select-pago_id option:selected').data('monto');
                $('#input-monto').val(monto);
            });
        });
    </script>
@stop