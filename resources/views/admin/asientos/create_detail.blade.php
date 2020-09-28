
<div class="table-responsive">
    <div class="col-md-12" style="margin:0px">
        <div id="accordion">
            <div class="card">
                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body" style="padding-bottom:0px">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="text-primary" for=""><b>Categoria</b></label><br>
                                <select id="select-categoria_id" class="form-control select-filtro" data-tipo="subcategorias" data-destino="subcategoria_id">
                                    <option value="">Todas</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="text-primary" for=""><b>Subcategoria</b></label><br>
                                <select id="select-subcategoria_id" class="form-control select-filtro" data-tipo="marcas" data-destino="marca_id">
                                    <option value="">Todas</option>
                                    <option disabled value="">Debe seleccionar una categoría</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="text-primary" for=""><b>Marca</b></label><br>
                                <select id="select-marca_id" class="form-control select-filtro" data-tipo="tallas" data-destino="talla_id">
                                    <option value="">Todas</option>
                                    <option disabled value="">Debe seleccionar una subcategoria</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="input-group">
    <select name="select_producto" class="form-control select2" id="select-producto_id" onchange="agregar_producto()">
        <option selected disabled value="">Seleccione una opción</option>
        @foreach ($productos as $item)
            <option value="{{ $item->id }}"
                    data-categoria="{{ $item->subcategoria }}"
                    data-marca="{{ $item->marca }}"
                    data-talla="{{ $item->talla }}"
                    data-color="{{ $item->color }}"
                    data-precio="{{ $item->moneda }} {{ $item->precio_venta }}"
                    data-detalle="{{ $item->descripcion_small }}">
                {{ $item->nombre }}
            </option>
        @endforeach
    </select>
    <span class="input-group-btn">
        <button class="btn btn-primary" style="margin-top:0px;padding:8px" type="button" title="Ver filtros" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Filtros <span class="voyager-params" aria-hidden="true"></span></button>
    </span>
</div>
<br>
<input type="hidden" name="compra_productos" value="1">
<table class="table table-bordered" >
    <thead style="background-color:#F8FAFC">
        <td class="">Cantidad</td>
        <td>Detalle</td>
        <td>Precio de compra</td>
        <td>Precio de venta</td>
        <td>Ganancia</td>
        <td>Subtotal</td>
        <td width="50px"></td>
    </thead>
    <tbody>
        <tr id="tr-total">
            <td colspan="5" class="text-right"><b>Costo Envío</b></td>
            <td colspan="2">
                <input type="text" placeholder="Costo envío" class="form-control">
            </td>
        </tr>
        <tr>
            <td colspan="5" class="text-right"><b>TOTAL</b></td>
            <td><b id="label-total">0.00 Bs.</b></td>
            <td></td>
        </tr>
    </tbody>
</table>
<script>
    $(document).ready(function(){
        // $('#select-producto_id').select2();
        rich_select('select-producto_id');

        // Cuando se abre el acordeon se inizializan los select2 que tiene dentro
        $('#accordion').on('show.bs.collapse', function () {
            setTimeout(function(){
                $('#select-categoria_id').select2();
                $('#select-subcategoria_id').select2();
                $('#select-marca_id').select2();
                $('#select-talla_id').select2();
                $('#select-genero_id').select2();
                $('#select-color_id').select2();
            }, 100);
        });

        // realizar filtro
        $('.select-filtro').change(function(){
            let tipo = $(this).data('tipo');
            let destino = $(this).data('destino');

            if(tipo){
                obtener_lista(tipo, '{{url("admin/productos/list")}}', destino);
            }

            filtro('{{url("admin/ofertas/filtros/filtro_simple/all")}}', '{{ setting('admin.modo_sistema') }}');
        });

        // calcular datos complementarios de impuestos
        $('.calculable').change(function(){
            calcular()
        });
        $('.calculable').keyup(function(){
            calcular()
        });

        // vaciar formularios
        $('#btn-reset').click(function(){
            $(".label-subtotal").text('0.00');
            $("#label-total").text('0.00 Bs.');
        });
    });

    function agregar_producto(){
        let id = $('#select-producto_id').val();
        $.get("{{url('admin/productos/get_producto')}}/"+id, function(data){
            agregarTr(data.id, data.nombre, data.precio);
        });
    }

    // agregar fila
    // variable de numero de filas
    var cont = 1;
    function agregarTr(id, nombre, precio_venta){
        $('#tr-total').before(` <tr id="tr-${cont}" class="tr-detalle">
                                    <td class="@if(setting('empresa.tipo_actividad')=='servicios') hidden @endif"><input style="width:80px" type="number" data-indice="${cont}" class="form-control" onchange="calcular_subtotal(${cont})" onkeyup="calcular_subtotal(${cont})" id="cantidad-${cont}" min="0.1" step="0.01" value="1" name="cantidad[]"></td>
                                    <td>
                                        <input type="hidden" class="input-producto_id" data-cont="${cont}" name="producto[]" value="${id}">
                                        <button type="button" class="btn btn-link" title="Ver información" onclick="producto_info(${id})">${nombre}</button>
                                    </td>
                                    <td>
                                        <input style="width:100px" type="number" min="0.01" step="0.01" data-indice="${cont}" class="form-control" onchange="calcular_subtotal(${cont})" onkeyup="calcular_subtotal(${cont})" id="precio-${cont}" value="0" name="precio[]" required>
                                    </td>
                                    <td>
                                        <input style="width:100px" type="number" min="0.01" step="0.01" class="form-control" id="precio_venta-${cont}" onchange="calcular_ganancia(${cont})" onkeyup="calcular_ganancia(${cont})" name="precio_venta[]" value="${precio_venta}" required>
                                    </td>
                                    <td>
                                        <b id="label-ganancia-${cont}" style="font-weight:bold;font-size:18px">0.00</b>
                                    </td>
                                    <td><b class="label-subtotal" id="label-subtotal-${cont}" style="font-weight:bold;font-size:20px">0.00</b></td>
                                    <td>
                                        <button type="button" onclick="borrarDetalleCompra(${cont})" class="btn btn-danger"><span class="voyager-trash"></span></button>
                                    </td>
                                </tr>`);
        calcular_subtotal(cont)
        cont++;
    }

    // calcular precio de producto seleccionado
    function calcular_precio(indice){
        let id = $(`#select_producto_id${indice}`).val();
        let precio = $(`#select_producto_id${indice} option:selected`).data('precio');
        if(precio){
            // $('#precio-'+indice).val(precio);
            // verificar si existe el producto en la lista
            let cont_productos = 0;
            $(".select_producto").each(function(){
                if($(this).val()==id){
                    cont_productos += 1;
                }
            });
            if(cont_productos>1){
                $(`#select_producto_id${indice}`).select2('destroy');
                $(`#select_producto_id${indice}`).val('');
                $('#precio-'+indice).val('0.00');
                calcular_subtotal(indice);
                toastr.warning('No puede elegir un producto más de una vez.', 'Información');
                setTimeout(function(){
                    $(`#select_producto_id${indice}`).select2();
                }, 500);
            }
            calcular_subtotal(indice);
        }else{
            $('#precio-'+indice).val('0.00');
            calcular_subtotal(indice);
        }
    }

    // Calcular porcentaje de precio de venta
    function calcular_ganancia(num){
        let precio = parseFloat($(`#precio-${num}`).val());
        let precio_venta = parseFloat($(`#precio_venta-${num}`).val());
        if(precio_venta){
            if(precio_venta>precio){
                let aumento = precio_venta - precio;
                let porcentaje = (precio > 0) ? parseInt((aumento*100)/precio)+' %' : '';
                $(`#label-ganancia-${num}`).html((precio_venta-precio).toFixed(2)+'<br><small class="text-primary">'+porcentaje+'</small>');
                toastr.remove();
            }else{
                toastr.remove();
                toastr.error('El precio de venta debe ser mayor al precio de compra.')
                $(`#label-ganancia-${num}`).text('0.00');
            }
        }
    }
</script>
