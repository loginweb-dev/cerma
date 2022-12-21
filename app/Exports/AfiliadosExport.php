<?php

namespace App\Exports;

use App\Afiliado;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class AfiliadosExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements WithCustomValueBinder, FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Afiliado::select('id', 'nombre_completo', 'ci', 'rau', 'movil', 'localidad', 'direccion', 'fecha_afiliacion')->get();
    }

    public function headings(): array
    {
        return [
            'Código',
            'Nombre completo',
            'CI',
            'RAU',
            'Celular',
            'Localidad',
            'Dirección',
            'Fecha de afiliación'
        ];
    }
}
