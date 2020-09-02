<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th colspan="7" class="text-center h3">Planilla de recepciones</th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Completo</th>
                        <th>RAU</th>
                        <th>Litros</th>
                        <th>Precio Unid.</th>
                        <th>Total</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recepciones as $item)
                    @php
                        $total = $item->total_litros * $item->precio_unidad;
                    @endphp
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nombre_completo }}</td>
                        <td>{{ $item->rau ?? 'Sin RAU' }}</td>
                        <td>{{ number_format($item->total_litros, 2, ',', '.') }}</td>
                        <td>{{ number_format($item->precio_unidad, 2, ',', '.') }}</td>
                        <td>{{ number_format($total, 2, ',', '.') }}</td>
                        <td class="text-right">
                            <a href="{{ url('admin/recibo/aportacion/'.$item->id) }}" title="Imprimir recibo" target="_blank" class="btn btn-sm btn-danger view">
                                <i class="voyager-polaroid"></i> <span class="hidden-xs hidden-sm">Imprimir</span>
                            </a>
                        </td>
                    </tr>
                        @php
                    @endphp
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay datos registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){

    });
</script>