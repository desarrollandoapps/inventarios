<?php

namespace App\Imports;

use App;
use App\Producto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class ProductoImport implements ToModel
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $proveedor = App\Proveedor::select('id')
                                    ->where('codigo', $row[2])
                                    ->first();

        return new Producto([
            'referencia' => $row[0],
            'descripcion' => $row[1],
            'idProveedor' => $proveedor->id
        ]);
    }
}
