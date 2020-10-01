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
            'enero' => $row[1],
            'febrero' => $row[2],
            'marzo' => $row[3],
            'abril' => $row[4],
            'mayo' => $row[5],
            'junio' => $row[6],
            'julio' => $row[7],
            'agosto' => $row[8],
            'septiembre' => $row[9],
            'octubre' => $row[10],
            'noviembre' => $row[11],
            'diciembre' => $row[12],
            'total' => $row[13],
        ]);
    }
}
