@extends('voyager::master')

@section('page_title', 'Registrar Aporte')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-dollar"></i> Registrar Aporte
    </h1>
@stop

@section('css')
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <form action="{{ route('dineroafiliados.store') }}" method="POST">
                @csrf
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Fecha</label>
                                    <div style="border-style: outset;">
                                    <input type="date" name="fecha" class="form-control" value="{{ date('Y-m-d') }}" required>
                                    @error('fecha')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Afiliado</label>
                                    <div style="border-style: outset;">
                                    <select name="afiliado_id" class="form-control" id="select-afiliado_id" required>
                                    </select>
                                    @error('afiliado_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                            
                                <div class="form-group col-md-6">
                                    <h3 class="text-center">Pago</h3>
                                    <div class="form-group col-md-6">
                                        <label>Precio Leche</label>
                                        <div style="border-style: outset;">

                                        <input type="number" name="precio_unitario" id="precio_unitario" class="form-control text-center" min="0.1" step="0.1" value="0" required>
                                        @error('precio_unitario')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Cantidad Lts.</label>
                                        <div style="border-style: outset;">
                                        <input type="number" name="litros" id="litros" class="form-control text-center" min="0.1" step="0.1" value="0" required>
                                        @error('litros')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label><b>Subtotal Leche</b></label>
                                        <div style="border-style: outset;">
                                        <input type="number" name="total_leche" id="total_leche" class="form-control text-center" min="0.1" step="0.1" value="0" readonly required>
                                        @error('total_leche')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label><b>Subtotal Cobro</b></label>
                                        <div style="border-style: outset;">
                                        <input type="number" name="total_cobro" id="total_cobro" class="form-control text-center" min="0.1" step="0.1" value="0" readonly required>
                                        @error('total_cobro')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        
                                    </div>

                                    <div class="form-group col-md-6">
                                        <h4><b>Total a Pagar</b></h4>
                                        <div style="border-style: outset;">
                                        <input type="number" name="total_a_pagar" id="total_a_pagar" class="form-control text-center" min="0.1" step="0.1" value="0" readonly required>
                                        @error('total_a_pagar')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                   
                                    
                                </div>

                                <div class="form-group col-md-6">
                                    <h3 class="text-center">Cobros</h3>
                                    <div class="col-md-6">
                                        <label> Seleccionar Cobro</label>
                                        <div style="border-style: outset;">
                                        <select name="aporte_codigo" class="form-control select2" id="aporte_codigo" required>
                                            @foreach ($cuentas as $item)
                                                <option value="{{$item->codigo}}">{{$item->nombre}}</option>
                                            @endforeach
                                        </select>
                                        @error('aporte_codigo')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <a id="table3-new-row-button" onclick="agregar_fila_cobro()"  class="btn btn-sm btn-dark">Agregar Cobro</a>
                                    </div>
                                    <table class="table table-striped table-bordered" id="table2">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th class="text-center" scope="col">Codigo</th>
                                                <th class="text-center" scope="col">Nombre</th>
                                                <th class="text-center" scope="col">Monto</th>
                                            </tr>
        
                                        </thead>
                                        <tbody>
                                            {{-- <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
        
                                            </tr> --}}
                                        </tbody>
                                       
                                    </table>
                                    <div hidden>
                                        <input id="cobros" name="cobros" type="text">
                                    </div>
                                    {{-- <input name="cobros[nombre][]" type="text">
                                    <input name="cobros[monto][]" type="text"> --}}
                                    {{-- <div class="col-md-6">
                                        <a  onclick="crear_array()"  class="btn btn-sm btn-dark">Añadir </a>
                                    </div> --}}
                                    


                                </div>

                                <div class="form-group col-md-12">
                                    <label>Observación</label>
                                    <textarea name="observaciones" class="form-control" rows="3" required></textarea>
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
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

@stop

@section('javascript')
    <script src="{{ url('plugins/formatSelect2.js') }}"></script>
    <script>
         function agregar_fila_cobro() {

            var aporte_codigo= $("#aporte_codigo").val()
            var aporte_text= $( "#aporte_codigo option:selected" ).text();

            $('#table2').append("<tr><td class='text-center'>"+aporte_codigo+"</td><td class='text-center'>"+aporte_text+"</td><td class='text-center'>0</td></tr>");
            example2.init();
        }

        function update_cobros(params) {
            var table2 = document.getElementById("table2");
            var monto= 0
            for (var i = 1, row; row = table2.rows[i]; i++) {
                
                    monto+= parseInt(row.cells[2].innerText)
                
            }
            var sub_cobro= parseInt($("#total_cobro").val())
            $("#total_cobro").val(monto)
            update_total()
        }

        function update_total() {
            var sub_pago= parseFloat($("#total_leche").val()).toFixed(2)
            var sub_cobro= parseFloat($("#total_cobro").val()).toFixed(2)
            var total= (sub_pago-sub_cobro).toFixed(2)
            $("#total_a_pagar").val(total)

        }

        $("#litros").change( function () { 
            var precio= parseFloat($("#precio_unitario").val()).toFixed(2)
            var cantidad= parseFloat($("#litros").val()).toFixed(2)
            var subtotal= (precio*cantidad).toFixed(2)
            $("#total_leche").val(subtotal)
            update_total()
        });

        function crear_array() {
            var cobros=[];
            var table2 = document.getElementById("table2");
            for (var i = 1, row; row = table2.rows[i]; i++) {
                cobros.push({codigo: parseInt(row.cells[0].innerText), nombre: row.cells[1].innerText, monto: parseFloat(row.cells[2].innerText).toFixed(2)})                
            }
            $('[name="cobros"]').val( JSON.stringify( cobros ) );
        }
        
        // $("#total_leche").keyup( function () {
        //     var precio= parseInt($("#precio_unitario").val())
        //     var cantidad= parseInt($("#litros").val())
        //     var subtotal= precio*cantidad
        //     $("#total_leche").val(subtotal) 
        //     update_total()
        // });

        var example2 = new BSTable("table2", {
                editableColumns:"2",
                // $addButton: $('#table2-new-row-button'),
                onEdit:function() {
                    update_cobros()
                    crear_array()
                    console.log("EDITED");
                },
                onDelete: function() {
                    update_cobros()
                    crear_array()
                    console.log("DELETED");
                },
                advanced: {
                    columnLabel: ''
                }
            });
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

          
        });

       

      
    </script>
@stop