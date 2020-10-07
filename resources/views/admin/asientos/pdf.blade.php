<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Favicon -->
        <?php $admin_favicon = Voyager::setting('admin.icon_image', ''); ?>
        @if($admin_favicon == '')
            <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/png">
        @else
            <link rel="shortcut icon" href="{{ Voyager::image($admin_favicon) }}" type="image/png">
        @endif
        <title>ASIENTO CONTABLE #{{ $asiento->id }}</title>
        <style>
            .btn-print{
                background-color: #fa2a00;
                color:white;
                border: 1px solid #fa2a00;
                padding: 5px 8px;
                border-radius:5px
            }
            @media print {
                #print{
                    display: none;
                }
            }
            body{
                font-size: 12px;
                font-family: 'Noto Sans', sans-serif;
                /* border: 1px solid black;
                border-radius: 1px; */
                padding: 5px 10px;
                margin: 0px
            }
		</style>
    </head>
    <body>
        <table width="100%">
            <tr>
                <td width="30%" align="center" style="font-size:7px">
                    <img src="{{ setting('admin.icon_image') ? url('storage').'/'.setting('admin.icon_image') : url('images/icon.png') }}" alt="loginweb" width="60px"><br>
                    <b >{{ setting('recibo.titulo') }}</b><br>
                    <b>Telf: {{ setting('recibo.celular') }}</b><br>
                    <b>{{setting('recibo.direccion')}}</b><br>
                    <b>{{setting('recibo.localidad')}}</b><br>
                </td>
                <td width="70%" align="right"><span style="margin-bottom:0px;font-weight:bold;font-size:18px">ASIENTO CONTABLE #{{ str_pad($asiento->id, 5, "0", STR_PAD_LEFT) }}</span></td>
                {{-- <td width="30%" align="right"><span style="font-weight:bold;color:red;font-size:15px;"></span></td> --}}
            </tr>
        </table>

        <table width="100%" align="center" style="margin-top: -40px">
            <tr>
                @php
                    // Carbon\Carbon::setLocale('es');
                    setlocale(LC_ALL, 'es_ES');
                @endphp
                <td align="left"><b>Fecha:</b> </td>
                <td>{{  strftime("%d %B, %Y", strtotime($asiento->created_at)) }} </td>
                <td align="right"><b>Empresa:</b></td>
                <td align="center">{{setting('admin.title')}}</td>
            </tr>
        </table>
        <table width="100%" border="1px" cellspacing="0" cellpadding="2" style="margin-top: -10px">
            <tr style="background-color:#022A81;color:#fff">
                <td align="center" width="80px"><b>Fecha&deg;</b></td>
                {{-- <td align="center" width="80px"><b>Código</b></td> --}}
                <td align="center" width="50px"><b>Codigo</b></td>
                <td align="center" ><b>Detalle Cuenta</b></td>
                <td align="center" width="100px"><b>Debe</b></td>
                <td align="center" width="100px"><b>Haber</b></td>

            </tr>
            @forelse ($asiento->items as $item)
                <tr>
                    <td>{!! \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') !!}</td>
                    <td>{{ $item->codigo }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{number_format($item->debe, 2, ',', '.')}}</td>
                    <td>{{number_format($item->haber, 2, ',', '.')}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay datos registrados</td>
                </tr>
            @endforelse
                <tr>
                    <td colspan="5" align="center">{{ $asiento->glosa }}</td>
                </tr>
                <tr>
                    <td colspan="3" align="right"><b>TOTAL</b></td>
                    <td align="center"><b>{{number_format($asiento->total_debe, 2, ',', '.')}}</b></td>
                    <td align="center"><b>{{number_format($asiento->total_haber, 2, ',', '.')}}</b></td>
                </tr>
                <tr>
                    <td colspan="5"><b> Son: {{ NumerosEnLetras::convertir(number_format($asiento->total_debe, 2, '.', ''),'Bolivianos',false,'Centavos') }} </b></td>
                </tr>
        </table>
        @if ($asiento->comprobante)
        <table width="100%" align="center" style="margin-top: 30px">
            <tr>
                <td align="center" width="100%">
                    <img src="{{url('storage').'/'.$asiento->comprobante}}" alt="comprobante" width="500px">
                </td>
            </tr>
        </table>
        @endif

        
        <div style="position: fixed; bottom: 120px; left: 0px; right: 0px">
            <table width="100%" align="center" border="1" cellspacing="0" cellpadding="5">
                <tr>
                    <td align="center">
                        <p style="margin-top: 50px">_______________________</p>
                        <p>Recibido por</p>
                    </td>
                    <td align="center">
                        <p style="margin-top: 50px">_______________________</p>
                        <p>Contador</p>
                    </td>
                    <td align="center">
                        <p style="margin-top: 50px">_______________________</p>
                        <p>Tesorero</p>
                    </td>
                    <td align="center">
                        <p style="margin-top: 50px">_______________________</p>
                        <p>Presidente</p>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
