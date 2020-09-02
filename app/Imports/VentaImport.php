<?php

namespace App\Imports;

use App\Venta;
use Maatwebsite\Excel\Concerns\ToModel;

class VentaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Venta([
            //
        ]);
    }
}
