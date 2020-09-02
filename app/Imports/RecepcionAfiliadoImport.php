<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\RecepcionAfiliado;

class RecepcionAfiliadoImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $resultados = collect();
        foreach ($collection as $row) {
            $total_litros = 0;
            if(is_int($row[0]) && $row[1] && $row[2]){
                // dd($row);
                for ($i=3; $i < 18; $i++) { 
                    $total_litros += intval($row[$i]);
                }
                // dd($total_litros, $row);

                RecepcionAfiliado::create([
                    // $resultados->push([
                    'afiliado_id' => $row[0],
                    'acopio' => $row[2],
                    'total_litros' => $total_litros,
                    'precio_unidad' => $row[19],
                    'observaciones' => '',
                    'periodo' => date('Y-m-d'),
                    'estado' => 0
                ]);
            }
        }
        // dd(json_decode($resultados));
    }
}
