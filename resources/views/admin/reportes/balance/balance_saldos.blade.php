<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th colspan="10" class="text-center h3">Balance General {{ $f_inicio }} hasta {{ $f_fin }}</th>
                    </tr>
                    <tr>
                        <th>Codigo</th>
                        <th>Detalle Cuenta</th>
                        <th>Debe</th>
                        <th>Haber</th>
                        <th>Saldo Deudor</th>
                        <th>Saldo Acreedor</th>
                        <th>Egresos</th>
                        <th>Ingresos</th>
                        <th>Activos</th>
                        <th>Pasivos</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $utilidad = 0;
                        $total_ingresos=0;
                        $total_egresos=0;
                        $total_activos = 0;
                        $total_pasivos = 0;
                    @endphp
                    @forelse ($balance as $mayor)
                        @php
                         $saldo_deudor = 0;
                         $saldo_acreedor = 0;
                         $ingresos = 0;
                         $egresos = 0;
                         $activos = 0;
                         $pasivos = 0;

                        if ($mayor->Debe > $mayor->Haber) {
                            $saldo_deudor = $mayor->Debe - $mayor->Haber;
                        } else {
                            $saldo_acreedor = $mayor->Haber - $mayor->Debe;
                        }
                        switch ($mayor->tipo) {
                            case 'A':
                               $activos = $saldo_deudor;
                                break;
                            case 'G':
                                $egresos = $saldo_deudor;
                                break;
                            case 'P':
                                $pasivos = $saldo_acreedor;
                                break;
                            case 'I':
                                $ingresos = $saldo_acreedor;
                                break;
                        }
                        $total_ingresos +=  $ingresos;
                        $total_egresos +=  $egresos;

                        $utilidad = $total_ingresos - $total_egresos;

                        $total_activos +=  $activos;
                        $total_pasivos +=  ($pasivos + $utilidad);
                        @endphp
                        <tr>
                            <td>{{ $mayor->codigo }}</td>
                            <td>{{ $mayor->name }}</td>
                            <td>{{ number_format($mayor->Debe, 2, ',', '.') }}</td>
                            <td>{{ number_format($mayor->Haber, 2, ',', '.') }}</td>
                            <td>{{ number_format($saldo_deudor, 2, ',', '.') }}</td>
                            <td>{{ number_format($saldo_acreedor, 2, ',', '.') }}</td>
                            <td>{{ number_format($ingresos, 2, ',', '.') }}</td>
                            <td>{{ number_format($egresos, 2, ',', '.') }}</td>
                            <td>{{ number_format($activos, 2, ',', '.') }}</td>
                            <td>{{ number_format($pasivos, 2, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No hay datos registrados</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">Utilidad</td>
                        <td colspan="2">{{ $utilidad }}</td>
                        <td>{{ number_format($total_activos, 2, ',', '.') }}</td>
                        <td>{{ number_format($total_pasivos, 2, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script>

</script>
