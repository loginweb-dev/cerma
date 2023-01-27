<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recibo de Pago Afiliado</title>
    <style>
        .bg-primary{
            background-color: #349c64;
        }
    </style>
</head>
<body>
    @php
        $numero_recibo = str_pad($recepcion[0]->id, 6, "0", STR_PAD_LEFT);
        $quincena_pago= strtotime($recepcion[0]->gestion);
        $dia= date("d", $quincena_pago);
        $mes= date("m", $quincena_pago);
        $quincena='';
        if ($dia==01) {
            $quincena='1er';
        }
        else{
            $quincena='2da';
        }

        $mes_texto= date("F", $quincena_pago);

        setlocale(LC_TIME, 'es_ES');
        $monthNum  = $mes;
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = ucfirst(strftime('%B', $dateObj->getTimestamp()));

        
    @endphp
    <table width="100%" border="1" cellspacing="0" style="margin-bottom: 5px">
        <tr style="text-align: center">
            <td width="35%" class="bg-primary"><h4>{{ setting('recibo.titulo') }}</h4></td>
            <td width="30%">
                <b style="font-size: 20px">Recibo de Pago Afiliado</b>
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
            <td colspan="6" class="bg-primary"><small>Afiliado </small>: <b style="font-size: 16px">{{ $recepcion[0]->afiliado->nombre_completo }}</b></td>
            <td rowspan="3" width="100px">{!!QrCode::size(100)->generate('Recibo de Pago Afiliado #'.$numero_recibo.': '.$recepcion[0]->afiliado->nombre_completo.' en fecha '.date('d-m-Y', strtotime($recepcion[0]->created_at))) !!}</td>
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
            <td class="bg-primary"><b>Quincena de Pago</b></td>
            <td>{{$quincena}} Quincena de {{$monthName}}</td>
        </tr>
    </table>
    <h3>
        Importe Leche
    </h3>
    <table  width="100%" border="1" cellspacing="0" cellpadding="5" style="margin-bottom: 5px">
        <thead >
            <tr class="bg-primary">
                <th class="text-center">N&deg;</th>
                <th class="text-center">Concepto</th>
                <th class="text-center">Monto</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td class="text-center">1</td>
                <td class="text-center">Total Litros</td>
                <td class="text-center">{{$recepcion[0]->litros}}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Precio Unitario</td>
                <td>{{$recepcion[0]->precio_unitario}}</td>
            </tr>
            <tr>
                <td>3</td>
                <td class="text-right"><b>Subtotal</b></td>
                <td>{{$recepcion[0]->total_leche}}</td>
            </tr>

            {{-- @php
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
            </tr> --}}
        </tbody>
    </table>
    <h3>
        Retenciones
    </h3>
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
                $cant= count($asiento->items);
                $index=0;
            @endphp
            @foreach ($asiento->items as $key => $item)
                @if (($key % 2) == 0)
                    @if ($key+2!=$cant)
                    @php
                        $index+=1;
                    @endphp
                    <tr>
                        <td class="text-center">{{$index}}</td>
                        <td class="text-center">{{$item->name}}</td>
                        <td class="text-center">{{$item->debe}}</td>
                    </tr>
                    @endif
                @endif
            @endforeach
            <tr>
                <td>{{($index+1)}}</td>
                <td><b>Subtotal</b></td>
                <td>{{$recepcion[0]->total_cobro}}</td>
            </tr>
        </tbody>
    </table>
    <h3>
        Totales
    </h3>
    <table width="100%" border="1" cellspacing="0" cellpadding="5" style="margin-bottom: 5px">
        <thead>
            <tr class="bg-primary">
                <th>N&deg;</th>
                <th>Concepto</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Subtotal Importe Leche</td>
                <td>{{$recepcion[0]->total_leche}}</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Subtotal Retenciones</td>
                <td>{{$recepcion[0]->total_cobro}}</td>
            </tr>
            <tr class="success">
                <td class="success">3</td>
                <td class="success"><b>Total a Pagar al Afiliado</b></td>
                <td class="success"><b>{{$recepcion[0]->total_a_pagar}}</b></td>
            </tr>

        </tbody>
    </table>
    {{-- <div style="margin-bottom: 10px">
        Son: {{ NumerosEnLetras::convertir(number_format($total, 2, '.', ''),'Bolivianos',false,'Centavos') }}
    </div> --}}
    <table width="100%" border="1" cellspacing="0" cellpadding="5">
        <tbody>
            <tr class="bg-primary">
                {{-- <td>{{ setting('recibo.observaciones') }}</td> --}}
                <td>{{$recepcion[0]->observaciones ? 'Observación: '.$recepcion[0]->observaciones : 'Observación: '}}</td>

            </tr>
        </tbody>
    </table>
    {{-- <div style="position: fixed; bottom: 120px; left: 0px; right: 0px"> --}}
        <div>
        <table width="100%" align="center" border="1" cellspacing="0" cellpadding="5">
            <tr>
                <td align="center">
                    <p style="margin-top: 30px">_______________________</p>
                    <p>CERMA</p>
                </td>
                <td align="center">
                    <p style="margin-top: 30px">_______________________</p>
                    <p>RECIBIDO CONFORME</p>
                </td>
                {{-- <td align="center">
                    <p style="margin-top: 50px">_______________________</p>
                    <p>Tesorero</p>
                </td>
                <td align="center">
                    <p style="margin-top: 50px">_______________________</p>
                    <p>Presidente</p>
                </td> --}}
            </tr>
        </table>
    </div>
    <script>
        window.print()
    </script>
</body>
</html>