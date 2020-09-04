<div class="row">
    <div class="col-md-12">
        @if (count($recepciones))
            <br>
            <table class="table table-bordered">
                <tr>
                    <td><b>Nombre completo</b></td>
                    <td>{{ $recepciones[0]->nombre_completo }}</td>
                    <td><b>CI</b></td>
                    <td>{{ $recepciones[0]->movil }}</td>
                    <td rowspan="3" style="width: 120px;" class="text-center">
                        <img src="{{ url('storage/'.str_replace('.', '-cropped.', $recepciones[0]->foto)) }}" width="200px" alt="Fotografía">
                    </td>
                </tr>
                <tr>
                    <td><b>RAU</b></td>
                    <td>{{ $recepciones[0]->rau ?? 'Sin RAU' }}</td>
                    <td><b>Localidad</b></td>
                    <td>{{ $recepciones[0]->localidad ?? 'No definida' }}</td>
                </tr>
                <tr>
                    <td><b>Movil</b></td>
                    <td>{{ $recepciones[0]->movil ?? 'Ninguno' }}</td>
                    <td><b>Dirección</b></td>
                    <td>{{ $recepciones[0]->direccion ?? 'No definida' }}</td>
                </tr>
            </table>
        @endif
        <br>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th colspan="8" class="text-center h3">Historial de aportes </th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Precio Unid.</th>
                        <th>Litros</th>
                        <th>Total</th>
                        <th>Detalle</th>
                        <th>Periodo</th>
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
                        <td>{{ $item->id }}</td>
                        <td>{{ number_format($item->precio_unidad, 2, ',', '.') }}</td>
                        <td>{{ number_format($item->total_litros, 2, ',', '.') }}</td>
                        <td>{{ number_format($total_aporte, 2, ',', '.') }}</td>
                        <td>
                            <ul>
                                @foreach ($item->detalle as $detalle)
                                    <li>{{ $detalle->nombre }} : {{ $detalle->monto }} Bs.</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ date('d-m-Y', strtotime($item->periodo)) }}</td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No hay datos registrados</td>
                        </tr>
                    @endforelse
                    {{-- <tr>
                        <td colspan="4"><b>TOTAL</b></td>
                        <td><b>{{ number_format($total_litros, 2, ',', '.') }} Lts.</b></td>
                        <td><b>{{ number_format($total_monto, 2, ',', '.') }} Bs.</b></td>
                        <td></td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){

    });
</script>