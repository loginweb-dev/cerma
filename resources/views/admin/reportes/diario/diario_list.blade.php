<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th colspan="5" class="text-center h3">Lb Diario desde {{ $f_inicio }} hasta {{ $f_fin }}</th>
                    </tr>
                    <tr>
                        <th>Fecha</th>
                        <th>Codigo</th>
                        <th>Detalle Cuenta</th>
                        <th>Debe</th>
                        <th>Haber</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($diarios as $diario)
                        <tr>
                            <td colspan="5">Asiento # {{ $diario->id }}</td>
                        </tr>
                        @foreach ($diario->items as $item)
                            <tr>
                                <td>{!! \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') !!}</td>
                                <td>{{ $item->codigo }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->debe }}</td>
                                <td>{{ $item->haber }}</td>
                            </tr>

                        @endforeach
                        <tr>
                            <td colspan="5" align="center">{{ $diario->glosa }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No hay datos registrados</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>

</script>
