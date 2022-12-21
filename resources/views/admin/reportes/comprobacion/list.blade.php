<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th colspan="6" class="text-center h3">desde {{ $f_inicio }} hasta {{ $f_fin }}</th>
                    </tr>
                    <tr>
                        <th colspan="2"></th>
                        <th colspan="2">SUMAS</th>
                        <th colspan="2">SALDOS</th>
                    </tr>
                    <tr>
                        <th>Codigo</th>
                        <th>Detalle Cuenta</th>
                        <th>Debe</th>
                        <th>Haber</th>
                        <th>Deudor</th>
                        <th>Acreedor</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_debe = 0;
                        $total_haber = 0;
                        $total_deudor = 0;
                        $total_acreedor = 0;
                    @endphp
                    @forelse ($mayores as $mayor)
                        @php
                         $saldo_deudor = 0;
                         $saldo_acreedor = 0;
                         
                        if ($mayor->Debe > $mayor->Haber) {
                            $saldo_deudor = $mayor->Debe - $mayor->Haber;
                            $total_deudor += $saldo_deudor;
                        } else {
                            $saldo_acreedor = $mayor->Haber - $mayor->Debe;
                            $total_acreedor += $saldo_acreedor;
                        }
                        $total_debe += $mayor->Debe;
                        $total_haber += $mayor->Haber; 
                        @endphp
                        <tr>
                            <td>{{ $mayor->codigo }}</td>
                            <td>{{ $mayor->name }}</td>
                            <td>{{ number_format($mayor->Debe, 2, ',', '.') }}</td>
                            <td>{{ number_format($mayor->Haber, 2, ',', '.') }}</td>
                            <td>{{ number_format($saldo_deudor, 2, ',', '.') }}</td>
                            <td>{{ number_format($saldo_acreedor, 2, ',', '.') }}</td>
                        </tr>
                       
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No hay datos registrados</td>
                        </tr>
                    @endforelse
                    <tr>
                        <td colspan="2" align="right">Totales</td>
                        <td>
                            {{  number_format($total_debe, 2, ',', '.')  }}
                        </td>
                        <td>
                            {{  number_format($total_haber, 2, ',', '.')  }}
                        </td>
                        <td>
                            {{  number_format($total_deudor, 2, ',', '.')  }}
                        </td>
                        <td>
                            {{  number_format($total_acreedor, 2, ',', '.')  }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>

</script>
