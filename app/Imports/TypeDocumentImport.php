<?php

namespace App\Imports;

use App\Models\TypeDocument;
use App\Models\PlansOfAccount;
use App\Models\DetailAccount;
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
        return new DetailAccount([
           'plan_of_account_id' => $row[0],
           'code'     => $row[1],
           'name'    => $row[2],
        ]);
    }
}
