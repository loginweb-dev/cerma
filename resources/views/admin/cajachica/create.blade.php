@extends('voyager::master')

@section('page_title', 'Pagos')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-dollar"></i> Registrar Movimiento
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <form id="myFormID" action="{{ route('cajachica.store') }}" method="POST">
                @csrf
                <div class="col-md-12">
                    <div class="panel panel-bordered">
                        <div class="panel-body">
                            <div class="row">
                                {{-- <div class="form-group col-md-6">
                                    <label>Afiliado</label>
                                    <select name="afiliado_id" class="form-control" id="select-afiliado_id" required>
                                    </select>
                                    @error('afiliado_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}
                                <div class="form-group col-md-4">
                                    <label>Tipo</label>
                                    <select name="tipo_movimiento" class="form-control select2" id="select-tipo_movimiento" required>
                                        {{-- <option value="{{ $item->id }}" >{{ $item->nombre }}</option> --}}
                                        <option value="1" >Ingreso</option>
                                        <option value="2" >Egreso</option>
                                    </select>
                                    @error('tipo_movimiento')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4 div_debe">
                                    <label>Cuenta Debe</label>
                                    <select name="cuenta_debe_id" class="form-control select2" id="select-cuenta_debe_id" required>
                                        <option value="0">Seleccione la Cuenta</option>
                                        @foreach ($plan_de_cuentas as $item)
                                            <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                        @endforeach                                       
                                    </select>
                                    @error('cuenta_debe_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>  
                                <div class="form-group col-md-4 div_haber">
                                    <label>Cuenta Haber</label>
                                    <select name="cuenta_haber_id" class="form-control select2" id="select-cuenta_haber_id" required>
                                        <option value="0">Seleccione la Cuenta</option>
                                        @foreach ($plan_de_cuentas as $item)
                                            <option value="{{ $item->id }}" >{{ $item->name }}</option>
                                    @endforeach                                       
                                    </select>
                                    @error('cuenta_haber_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Monto</label>
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
                                    <label>Glosa</label>
                                    <textarea name="glosa" class="form-control" rows="3"></textarea>
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

@section('javascript')
    <script>
        $(document).ready(function(){


            //Logica Para que al Iniciar la Cuenta Debe sea Efectivo o su Equivalente y Tipo Ingreso
            $(".div_debe select").val(3).change();
            $('.div_debe option[value=3]').attr('selected','selected');
            $('#select-cuenta_debe_id').attr("disabled", true); 

            // console.log($(".id_100 select").val())

        });
        $( "#myFormID" ).submit(function( event ) {
            $('#select-cuenta_haber_id').attr("disabled", false); 
            $('#select-cuenta_debe_id').attr("disabled", false); 

        });
        $('#select-tipo_movimiento').on('change', function() {
            if($('#select-tipo_movimiento :selected').text()=="Ingreso"){
               
                //Logica Para que al Iniciar la Cuenta Debe sea Efectivo o su Equivalente y Tipo Ingreso
                $(".div_debe select").val(3).change();
                $('.div_debe option[value=3]').attr('selected','selected');
                $('#select-cuenta_debe_id').attr("disabled", true);
                
                
                $(".div_haber select").val(0).change();
                $('.div_haber option[value=0]').attr('selected','selected');
                $('#select-cuenta_haber_id').attr("disabled", false);  
            }
            else{
                 //Logica Para que al Iniciar la Cuenta Debe sea Efectivo o su Equivalente y Tipo Ingreso
                $(".div_haber select").val(3).change();
                $('.div_haber option[value=3]').attr('selected','selected');
                $('#select-cuenta_haber_id').attr("disabled", true); 

                $(".div_debe select").val(0).change();
                $('.div_debe option[value=0]').attr('selected','selected');
                $('#select-cuenta_debe_id').attr("disabled", false);  


            }
        });

        function cargar_debe(){

        }
        function cargar_haber(){

        }

    </script>
@stop