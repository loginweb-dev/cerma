<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet"> --}}
        <title>Libro Mayor</title>
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
                            <img src="{{url('storage').'/'.setting('admin.icon_image')}}" alt="loginweb" width="60px"><br>
                            <b>{{setting('empresa.nombre')}}</b><br>

                            @if(setting('empresa.telefono')!='')
                            <b>Telf: {{setting('empresa.telefono')}}</b>
                            @endif
                            @if(setting('empresa.telefono')!='' && setting('empresa.celular')!='')
                                -
                            @endif
                            @if(setting('empresa.celular')!='')
                            <b>Cel: {{setting('empresa.celular')}}</b><br>
                            @endif

                            <b>{{setting('empresa.direccion')}}</b><br>
                            <b>{{setting('empresa.ciudad')}}</b><br>
                        </td>
                        <td width="40%" align="center"><span style="margin-bottom:0px;font-weight:bold;font-size:25px">LIBRO Mayor</span></td>
                        <td width="30%" align="right"><span style="font-weight:bold;color:red;font-size:15px;"></span></td>
                    </tr>
                </table>
                {{-- datos de la venta --}}
                {{-- <div style="height:20px"></div> --}}
                <table width="90%" align="center">
                    <tr>
                        <td><b>F: Inicio</b></td>
                        <td>: {{ $f_inicio }}</td>
                        <td align="right"><b>Empresa:</b></td>
                        <td>: {{setting('admin.title')}}</td>
                    </tr>
                    <tr>
                        <td><b>Fecha</b></td>
                        <td>: {{ $f_fin }}</td>

                    </tr>
                </table>
                {{-- detalles de la venta --}}
                {{-- <div style="height:10px"></div> --}}
                <table width="100%" border="1px" cellspacing="0" cellpadding="2">
                    <tr style="background-color:#022A81;color:#fff">
                        {{-- <td align="center" width="80px"><b>Código</b></td> --}}
                        <td align="center"><b>Codigo</b></td>
                        <td align="center" width="50px"><b>Detalle Cuenta</b></td>
                        <td align="center" width="100px"><b>Debe</b></td>
                        <td align="center" width="100px"><b>Haber</b></td>
                        <td align="center" width="100px"><b>Saldo Deudor</b></td>
                        <td align="center" width="100px"><b>Saldo Acreedor</b></td>
                    </tr>

                     @forelse ($mayores as $mayor)
                        @php
                            $saldo_deudor = 0;
                            $saldo_acreedor = 0;
                            if ($mayor->Debe > $mayor->Haber) {
                                $saldo_deudor = $mayor->Debe - $mayor->Haber;
                            } else {
                                $saldo_acreedor = $mayor->Haber - $mayor->Debe;
                            }
                        @endphp
                         <tr>
                             <td>{{ $mayor->codigo }}</td>
                             <td>{{ $mayor->name }}</td>
                             <td>{{number_format($mayor->Debe, 2, ',', '.')}}</td>
                             <td>{{number_format($mayor->Haber, 2, ',', '.')}}</td>
                             <td>{{number_format($saldo_deudor, 2, ',', '.')}}</td>
                             <td>{{number_format($saldo_acreedor, 2, ',', '.')}}</td>
                         </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay datos registrados</td>
                        </tr>
                    @endforelse
                </table>
                {{-- datos de dosificacion --}}
                <div style="height:10px"></div>
                <table width="90%" align="center">
                    <tr>
                        <td><b> </b> </td>
                    </tr>
                </table>

        <script>
            // window.print();
            // setTimeout(function(){
            //     window.close();
            // }, 10000);
        </script>
    </body>
</html>
