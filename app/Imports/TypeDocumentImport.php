<?php

namespace App\Imports;

use App\Models\TypeDocument;
use Maatwebsite\Excel\Concerns\ToModel;

class TypeDocumentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TypeDocument([
           'code'     => $row[1],
           'name'    => $row[0],
        ]);
    }
}
