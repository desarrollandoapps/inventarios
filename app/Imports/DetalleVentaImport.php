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
        // dd($producto);
        return new DetalleVenta([
            'idProducto' => $producto->id,
            'cantidad' => $row[1],
            'valor' => $row[2],
        ]);
    }
}
