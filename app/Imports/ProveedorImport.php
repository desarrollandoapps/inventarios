<?php

namespace App\Imports;

use App\Proveedor;
use App\Exceptions\Handler;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class ProveedorImport implements ToModel, SkipsOnError, WithValidation, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Proveedor([
            'codigo' => $row[0],
            'nombre' => $row[1]
        ]);
    }

    public function rules(): array
    {
        return [
            '*.0' => ['unique:proveedors,codigo']
        ];
    }

    
}
