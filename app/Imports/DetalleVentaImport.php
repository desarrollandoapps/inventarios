<?php

namespace App\Imports;

use App;
use App\DetalleVenta;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class DetalleVentaImport implements ToModel
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $producto = App\Producto::select('id')
                                ->where('referencia', $row[0])
                                ->first();
        
        return new DetalleVenta([
            'idProducto' => $producto->id,
            'enero' => $row[1],
            'febrero' => $row[2],
            'marzo' => $row[3],
            'abril' => $row[4],
            'mayo' => $row[5],
            'junio' => $row[4],
            'julio' => $row[7],
            'agosto' => $row[8],
            'septiembre' => $row[9],
            'octubre' => $row[10],
            'noviembre' => $row[11],
            'diciembre' => $row[12],
        ]);
    }
}
