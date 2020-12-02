<title>Planilla de recepciones | {{ strftime("%B de %Y",  strtotime($periodo)) }}</title>
<div>
    <table width="100%" border="1" cellspacing="0" style="margin-bottom: 5px">
        <tr style="text-align: center">
            <td width="30%" class="bg-primary"><h4>{{ setting('recibo.titulo') }}</h4></td>
            <td width="40%">
                <h2>Planilla de recepciones | {{ strftime("%B de %Y",  strtotime($periodo)) }}</h2>
                <p style="font-size: 11px">
                    NIT: {{ setting('recibo.nit') }} <br>
                    {{ setting('recibo.direccion') }} <br>
                    CEL: {{ setting('recibo.celular') }} <br>
                    {{ setting('recibo.localidad') }}
                </p>
            </td>
            <td width="30%" class="bg-primary">
                <br>
                <img src="{{ asset('images/icon.png') }}" alt="Logo" width="100px">
            </td>
        </tr>
    </table>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Periodo</th>
                <th>ID</th>
                <th>Nombre Completo</th>
                <th>RAU</th>
                <th>Precio Unid.</th>
                <th>Litros</th>
                <th>Total</th>
                <th>Aportes</th>
                <th>Monto de descuento</th>
                <th>Liquido pagable</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_litros = 0;
                $total_recepcion = 0;
                $total_aportes = 0;
            @endphp
            @forelse ($recepciones as $item)
            @php
                $recepcion = $item->total_litros * $item->precio_unidad;
                $total_litros += $item->total_litros;
                $total_recepcion += $recepcion;
            @endphp
            <tr>
                <td>{{ date('d-m-Y', strtotime($item->periodo)) }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nombre_completo }}</td>
                <td>{{ $item->rau ?? 'Sin RAU' }}</td>
                <td>{{ number_format($item->precio_unidad, 2, ',', '.') }}</td>
                <td>{{ number_format($item->total_litros, 2, ',', '.') }}</td>
                <td>{{ number_format($recepcion, 2, ',', '.') }}</td>
                <td>
                    @php
                        $aporte_afiliados = \App\AporteAfiliado::with('aporte')->where('periodo', $periodo)->where('afiliado_id', $item->afiliado_id)->get();
                        $descuentos = 0;
                    @endphp
                    <ul>
                        @foreach ($aporte_afiliados as $aporte_afiliado)
                            <li><small>{{ $aporte_afiliado->aporte->nombre }}</small></li>
                            @php
                                $descuentos += $aporte_afiliado->monto;
                            @endphp
                        @endforeach
                        @php
                            $total_aportes += $descuentos;
                        @endphp
                    </ul>
                </td>
                <td>{{ number_format($descuentos, 2, ',', '.') }}</td>
                <td>{{ number_format($recepcion - $descuentos, 2, ',', '.') }}</td>
            </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">No hay datos registrados</td>
                </tr>
            @endforelse
            <tr>
                <td colspan="5"><b>TOTAL</b></td>
                <td><b>{{ number_format($total_litros, 2, ',', '.') }} Lts.</b></td>
                <td><b>{{ number_format($total_recepcion, 2, ',', '.') }} Bs.</b></td>
                <td></td>
                <td><b>{{ number_format($total_aportes, 2, ',', '.') }} Bs.</b></td>
                <td><b>{{ number_format($total_recepcion - $total_aportes, 2, ',', '.') }} Bs.</b></td>
            </tr>
        </tbody>
    </table>
</div>
<style>
    body{
        font-size: 12px
    }
</style>