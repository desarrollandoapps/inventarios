<?php

namespace App\Imports;

use App;
use App\Producto;
use App\Exceptions\Handler;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class ProductoImport implements ToModel, SkipsOnError, WithValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

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

    public function rules(): array
    {
        return [
            '*.0' => ['unique:productos,referencia']
        ];
    }
}
