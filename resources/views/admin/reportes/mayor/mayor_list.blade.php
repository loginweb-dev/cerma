<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th colspan="6" class="text-center h3">Libro Mayor desde {{ $f_inicio }} hasta {{ $f_fin }}</th>
                    </tr>
                    <tr>
                        <th>Codigo</th>
                        <th>Detalle Cuenta</th>
                        <th>Debe</th>
                        <th>Haber</th>
                        <th>Saldo Deudor</th>
                        <th>Saldo Acreedor</th>
                    </tr>
                </thead>
                <tbody>
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
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>

</script>
