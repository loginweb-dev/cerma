<form action="{{ url('admin/importar/recepciones/datos/store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th colspan="9" class="text-center h3">Planilla de recepciones</th>
                        </tr>
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>RAU</th>
                            <th>Litros</th>
                            <th>Precio Unid.</th>
                            <th>Total</th>
                            <th colspan="2" class="text-center">Descuentos</th>
                            <th>Liquido pagable</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recepciones as $item)
                            @php
                                $total = $item->total_litros * $item->precio_unidad;
                                $descuentos = ($item->total_litros * $aporte_leche) + $mensualidad;
                            @endphp
                            <tr>
                                <td>
                                    {{ $item->id }}
                                    <input type="hidden" name="id[]" value="{{ $item->id }}">
                                    <input type="hidden" name="afiliado_id[]" value="{{ $item->afiliado_id }}">
                                </td>
                                <td>{{ $item->nombre_completo }}</td>
                                <td>{{ $item->rau ?? 'Sin RAU' }}</td>
                                <td>{{ number_format($item->total_litros, 2, ',', '.') }}</td>
                                <td>{{ number_format($item->precio_unidad, 2, ',', '.') }}</td>
                                <td>{{ number_format($total, 2, ',', '.') }}</td>
                                <td>
                                    {{ number_format($item->total_litros * $aporte_leche, 2, ',', '.') }}
                                    <input type="hidden" name="aporte_leche[]" value="{{ $item->total_litros * $aporte_leche }}">
                                </td>
                                <td>
                                    {{ number_format($mensualidad, 2, ',', '.') }}
                                    <input type="hidden" name="mensualidad[]" value="{{ $mensualidad }}">
                                </td>
                                <td>{{ number_format($total - $descuentos, 2, ',', '.') }}</td>
                            </tr>
                            @php
                        @endphp
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No hay datos registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Fecha de planilla</label>
                <div class="input-group">
                    <input type="date" name="periodo" class="form-control" required>
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary" style="margin-top: 0px">
                            Guardar <i class="voyager-upload"></i>
                        </button>
                    </div>
                </div>
                <small>Si es la primera quincena elegir el día 15, si es la segunda quincena elegir el último día.</small>
            </div>
        </div>
    </div>
</form>
<script>
    $(document).ready(function(){

    });
</script>