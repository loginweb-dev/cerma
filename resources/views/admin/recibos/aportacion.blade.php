<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recibo de aportación</title>
    <style>
        .bg-primary{
            background-color: #349c64;
        }
    </style>
</head>
<body>
    @php
        $numero_recibo = str_pad($recepcion[0]->id, 6, "0", STR_PAD_LEFT);
    @endphp
    <table width="100%" border="1" cellspacing="0" style="margin-bottom: 5px">
        <tr style="text-align: center">
            <td width="35%" class="bg-primary"><h4>{{ setting('recibo.titulo') }}</h4></td>
            <td width="30%">
                <b style="font-size: 20px">Recibo de Cobro</b>
                <p style="font-size: 11px">
                    NIT: {{ setting('recibo.nit') }} <br>
                    {{ setting('recibo.direccion') }} <br>
                    CEL: {{ setting('recibo.celular') }} <br>
                    {{ setting('recibo.localidad') }}
                </p>
            </td>
            <td width="35%" class="bg-primary">
                <br>
                <img src="{{ asset('images/icon.png') }}" alt="Logo" width="100px">
                <div style="margin-top: 5px; margin-bottom: 5px">
                    <b style="font-size: 20px; color:red;">N&deg; {{ $numero_recibo }}</b>
                </div>
            </td>
        </tr>
    </table>
    <table width="100%" border="1" cellspacing="0" cellpadding="5" style="margin-bottom: 5px">
        <tr>
            <td colspan="6" class="bg-primary"><small>Recibimos de</small>: <b style="font-size: 16px">{{ $recepcion[0]->afiliado->nombre_completo }}</b></td>
            <td rowspan="3" width="100px">{!!QrCode::size(100)->generate('Recibo de Cobro #'.$numero_recibo.': '.$recepcion[0]->afiliado->nombre_completo.' en fecha '.date('d-m-Y', strtotime($recepcion[0]->created_at))) !!}</td>
        </tr>
        <tr>
            <td class="bg-primary"><b>RAU</b></td>
            <td>{{ $recepcion[0]->afiliado->rau ?? 'Sin RAU' }}</td>
            <td class="bg-primary"><b>Telefono</b></td>
            <td>{{ $recepcion[0]->afiliado->movil }}</td>
            <td class="bg-primary"><b>Fecha de recibo</b></td>
            <td>{{ date('d-m-Y', strtotime($recepcion[0]->created_at)) }}</td>
        </tr>
        <tr>
            <td class="bg-primary"><b>Dirección</b></td>
            <td>{{ $recepcion[0]->afiliado->direccion }}</td>
            <td class="bg-primary"><b>Ciudad</b></td>
            <td>{{ $recepcion[0]->afiliado->localidad }}</td>
            <td class="bg-primary"><b>Medio de pago</b></td>
            <td>Efectivo</td>
        </tr>
    </table>
    <table width="100%" border="1" cellspacing="0" cellpadding="5" style="margin-bottom: 5px">
        <thead>
            <tr class="bg-primary">
                <th>N&deg;</th>
                <th>Concepto</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            @php
                $cont = 1;
                $total = 0;
            @endphp
            @foreach ($recepcion as $item)
            <tr>
                <td>{{ $cont }}</td>
                <td>{{ $item->aporte->nombre }}</td>
                <td>Bs. {{ number_format($item->monto, 2, ',', '.') }}</td>
            </tr>
            @php
                $cont++;
                $total += $item->monto;
            @endphp
            @endforeach
            <tr>
                <td style="text-align: center" colspan="2"><b>TOTAL</b></td>
                <td><b>Bs. {{ number_format($total, 2, ',', '.') }}</b></td>
            </tr>
        </tbody>
    </table>
    <div style="margin-bottom: 10px">
        Son: {{ NumerosEnLetras::convertir(number_format($total, 2, '.', ''),'Bolivianos',false,'Centavos') }}
    </div>
    <table width="100%" border="1" cellspacing="0" cellpadding="5">
        <tbody>
            <tr class="bg-primary">
                {{-- <td>{{ setting('recibo.observaciones') }}</td> --}}
                <td>{{$recepcion[0]->observacion ? 'Observación: '.$recepcion[0]->observacion : 'Observación: '}}</td>

            </tr>
        </tbody>
    </table>
    <script>
        window.print()
    </script>
</body>
</html>