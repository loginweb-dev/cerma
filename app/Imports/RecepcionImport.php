<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\RecepcionAfiliado;

use App\Imports\RecepcionAfiliadoImport;

class RecepcionImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            0 => new RecepcionAfiliadoImport(),
            1 => new RecepcionAfiliadoImport(),
        ];
    }
}
