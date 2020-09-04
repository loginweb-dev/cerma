<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th colspan="8" class="text-center h3">Planilla de recepciones | {{ $periodo }}</th>
                    </tr>
                    <tr>
                        <th>Periodo</th>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>RAU</th>
                        <th>Precio Unid.</th>
                        <th>Litros</th>
                        <th>Total</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_litros = 0;
                        $total_monto = 0;
                    @endphp
                    @forelse ($recepciones as $item)
                    @php
                        $total_aporte = $item->total_litros * $item->precio_unidad;
                        $total_litros += $item->total_litros;
                        $total_monto += $total_aporte;
                    @endphp
                    <tr>
                        <td>{{ date('d-m-Y', strtotime($item->periodo)) }}</td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nombre_completo }}</td>
                        <td>{{ $item->rau ?? 'Sin RAU' }}</td>
                        <td>{{ number_format($item->precio_unidad, 2, ',', '.') }}</td>
                        <td>{{ number_format($item->total_litros, 2, ',', '.') }}</td>
                        <td>{{ number_format($total_aporte, 2, ',', '.') }}</td>
                        <td class="text-right">
                            <button title="Imprimir recibo" onclick="generar_recibo({{ $item->afiliado_id }}, '{{ $item->periodo }}')" class="btn btn-sm btn-danger view">
                                <i class="voyager-polaroid"></i> <span class="hidden-xs hidden-sm">Imprimir</span>
                            </button>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No hay datos registrados</td>
                        </tr>
                    @endforelse
                    <tr>
                        <td colspan="5"><b>TOTAL</b></td>
                        <td><b>{{ number_format($total_litros, 2, ',', '.') }} Lts.</b></td>
                        <td><b>{{ number_format($total_monto, 2, ',', '.') }} Bs.</b></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<form id="form-print" action="{{ url('admin/recibo/aportacion') }}" method="post" target="_blank">
    @csrf
    <input type="hidden" name="id">
    <input type="hidden" name="afiliado_id">
    <input type="hidden" name="periodo">
</form>
<script>
    $(document).ready(function(){

    });

    function generar_recibo(afiliado_id, periodo){
        $('#form-print input[name="afiliado_id"]').val(afiliado_id);
        $('#form-print input[name="periodo"]').val(periodo);
        $('#form-print').submit();
    }
</script>