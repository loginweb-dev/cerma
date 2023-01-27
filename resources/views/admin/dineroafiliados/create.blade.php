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
                                <div class="form-group col-sm-3">
                                    <label for="">Quincena</label>
                                    <div style="border-style: outset;">
                                        <select class="form-control" name="select_quincena" id="select_quincena">
                                            <option value="primera">Primer Quincena</option>
                                            <option value="segunda">Segunda Quincena</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Fecha</label>
                                    <div style="border-style: outset;">
                                    {{-- <input type="date" name="fecha" class="form-control" value="{{ date('Y-m-d') }}" required> --}}
                                    <input type="month" name="fecha" id="fecha" class="form-control" value="{{ date('Y-m') }}">

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
                                        <select name="aporte_codigo" class="form-control select2" id="aporte_codigo">
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
                                        <div class="col-sm-12">
                                            <a id="table3-new-row-button" onclick="agregar_fila_cobro()"  class="btn btn-sm btn-dark">Agregar Cobro</a>
                                        </div>
                                        <div class="col-sm-12">
                                            <a id="" onclick="agregar_cuentas_defecto()" class="btn btn-sm btn-dark">Cobros por Defecto</a>
                                        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.0/axios.min.js"></script>

    <script>
         function agregar_fila_cobro() {
            if ($("#litros").val()>0) {
                if ($("#aporte_codigo").val()!=null) {
                    
                
                    var aporte_codigo= $("#aporte_codigo").val()
                    var aporte_text= $( "#aporte_codigo option:selected" ).text();
                    console.log(comparar_exis_cobro(aporte_codigo))
                    if ((comparar_exis_cobro(aporte_codigo)!=true)||( count_cobros()==0)) {
                        $('#table2').append("<tr><td class='text-center'><input class='tab_cobros_id' type='number' value="+aporte_codigo+" hidden>"+aporte_codigo+"</td><td class='text-center'>"+aporte_text+"</td><td class='text-center'>0</td></tr>");
                        example2.init();
                        crear_array()
                    }
                    else{
                        toastr.error("Ese cobro ya existe en la lista.")
                    }
                }
                else{
                    toastr.error("No ha seleccionado ningún cobro")
                }
            }
            else{
                toastr.error("Primero agregue la cantidad de litros de leche correspondientes")
            }



           
        }
        function comparar_exis_cobro(id){
            var validador=false;
            $('.tab_cobros_id').each(function(){
                if (id==this.value) {
                    validador=true
                }
            })
            return validador;
        }
        function count_cobros(){
            var num=0
                $('.tab_cobros_id').each(function(){
                    num+=1
                })
            return num;
        }

        async function agregar_cuentas_defecto() {
            if ($("#litros").val()>0) {
                // $('#table2 tbody').empty();
                var defecto= await axios("/api/find/cuentas/default")
                for (let index = 0; index < defecto.data.length; index++) {
                    var monto=0
                    if ((comparar_exis_cobro(defecto.data[index].codigo)!=true)||( count_cobros()==0)) {
                        if (defecto.data[index].tipo_retencion=="fijo") {
                            if (defecto.data[index].monto<1) {
                                monto=parseFloat($("#litros").val()).toFixed(2)*parseFloat(defecto.data[index].monto).toFixed(2)
                            }
                            else{
                                monto=defecto.data[index].monto
                            }
                        }
                        else{
                            monto= (parseFloat($("#total_leche").val()).toFixed(2))*(parseFloat(defecto.data[index].monto).toFixed(2)/100)
                            console.log(monto)

                        }
                        $('#table2').append("<tr><td class='text-center'><input class='tab_cobros_id' type='number' value="+defecto.data[index].codigo+" hidden>"+defecto.data[index].codigo+"</td><td class='text-center'>"+defecto.data[index].nombre+"</td><td class='text-center'>"+monto.toFixed(2)+"</td></tr>");
                        example2.init();
                        update_cobros()
                        crear_array()
                    }
                    else{
                        toastr.error("El cobro "+defecto.data[index].nombre+" ya existe en la lista.")
                    }
                }
            }
            else{
                toastr.error("Primero agregue la cantidad de litros de leche correspondientes")
            }
        }

        function update_cobros() {
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
            $('#cobros').val( JSON.stringify( cobros ) );
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
            


            $("#precio_unitario").val("{{setting('aportes.precio_leche')}}")
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