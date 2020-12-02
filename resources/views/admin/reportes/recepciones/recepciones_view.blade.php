<form action="{{ url('admin/importar/recepciones/datos/store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th colspan="10" class="text-center h3">Planilla de recepciones</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>RAU</th>
                            <th>Precio Unid.</th>
                            <th>Litros</th>
                            <th>Total</th>
                            <th colspan="3" class="text-center">Descuentos</th>
                            <th>Liquido pagable</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_litros = 0;
                            $total_montos = 0;
                            $total_descuentos = 0;
                            $total_liquido_pagable = 0;
                        @endphp
                        @forelse ($recepciones as $item)
                            @php
                                $total = $item->total_litros * $item->precio_unidad;
                                $descuentos = ($item->total_litros * $aporte_leche) + $mensualidad;
                                $total_litros += $item->total_litros;
                                $total_montos += $total;
                                $total_descuentos += $descuentos;
                                $total_liquido_pagable += $total - $descuentos;
                            @endphp
                            <tr>
                                <td>
                                    {{ $item->id }}
                                    <input type="hidden" name="id[]" value="{{ $item->id }}">
                                    <input type="hidden" name="afiliado_id[]" value="{{ $item->afiliado_id }}">
                                </td>
                                <td>{{ $item->nombre_completo }}</td>
                                <td>{{ $item->rau ?? 'Sin RAU' }}</td>
                                <td>{{ number_format($item->precio_unidad, 2, ',', '.') }}</td>
                                <td>{{ number_format($item->total_litros, 2, ',', '.') }}</td>
                                <td>{{ number_format($total, 2, ',', '.') }}</td>
                                <td>
                                    {{ number_format($item->total_litros * $aporte_leche, 2, ',', '.') }}
                                    <input type="hidden" name="aporte_leche[]" value="{{ $item->total_litros * $aporte_leche }}">
                                </td>
                                <td>
                                    {{ number_format($mensualidad, 2, ',', '.') }}
                                    <input type="hidden" name="mensualidad[]" value="{{ $mensualidad }}">
                                </td>
                                <td>
                                    <div>
                                        @foreach (\App\Aporte::where('id', '>', 2)->where('deleted_at', NULL)->where('tipo', 'monto')->get() as $aporte)
                                        <input type="checkbox" name="aportes[]" value="{{ $item->id.'_'.$aporte->id }}"> {{ $aporte->nombre }} <br>
                                        @endforeach
                                    </div>
                                </td>
                                <td>{{ number_format($total - $descuentos, 2, ',', '.') }}</td>
                            </tr>
                            @php
                        @endphp
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">No hay datos registrados</td>
                            </tr>
                        @endforelse
                        <tr>
                            <td colspan="5">TOTAL</td>
                            <td>{{ number_format($total_litros, 2, ',', '.') }}</td>
                            <td>{{ number_format($total_montos, 2, ',', '.') }}</td>
                            <td colspan="2">{{ number_format($total_descuentos, 2, ',', '.') }}</td>
                            <td>{{ number_format($total_liquido_pagable, 2, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label>Periodo</label>
            <select name="dia" class="form-control" required>
                <option value="">Seleccione el periodo</option>
                <option value="1">Primera quincena</option>
                <option value="15">Segunda quincena</option>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label>Mes</label>
            <select name="mes" class="form-control" required>
                <option value="">Seleccione el mes</option>
                <option @if(date('m') == 1) selected @endif value="1">Enero</option>
                <option @if(date('m') == 2) selected @endif value="2">Febrero</option>
                <option @if(date('m') == 3) selected @endif value="3">Marzo</option>
                <option @if(date('m') == 4) selected @endif value="4">Abril</option>
                <option @if(date('m') == 5) selected @endif value="5">Mayo</option>
                <option @if(date('m') == 6) selected @endif value="6">Junio</option>
                <option @if(date('m') == 7) selected @endif value="7">Julio</option>
                <option @if(date('m') == 8) selected @endif value="8">Agosto</option>
                <option @if(date('m') == 9) selected @endif value="9">Septiembre</option>
                <option @if(date('m') == 10) selected @endif value="10">Octubre</option>
                <option @if(date('m') == 11) selected @endif value="11">Noviembre</option>
                <option @if(date('m') == 12) selected @endif value="12">Diciembre</option>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label>Año</label>
            <input type="number" class="form-control" name="anio" value="{{ date('Y') }}" required>
        </div>
        <div class="form-group col-md-3">
            <label>Nro de cuenta</label>
            <select name="cuenta_name" class="form-control" required>
                <option value="">Elija la cuenta</option>
                @foreach (\App\Models\DetailAccount::where('plan_of_account_id', 3)->get() as $item)
                <option value="{{ $item->name }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-12 text-right">
            <button class="btn btn-primary" type="submit">Guardar</button>
        </div>
    </div>
</form>
<style>
    .select2{
        width: 180px !important
    }
</style>
<script>
    $(document).ready(function(){
        
    });
</script>