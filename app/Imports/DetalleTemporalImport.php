<?php

namespace App\Imports;

use App\Producto;
use App\DetalleTemporal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class DetalleTemporalImport implements ToModel
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $referencia = $row[0];
        $producto = Producto::select('id')
                                ->where('referencia', $referencia)
                                ->first();

        return new DetalleTemporal([
            'idProducto' => $producto->id,
            'cantidad' => $row[1],
            'valor' => $row[2],
        ]);
    }
}
