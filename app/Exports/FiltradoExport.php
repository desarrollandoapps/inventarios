<?php

namespace App\Exports;

use App\Filtrado;
use Maatwebsite\Excel\Concerns\FromCollection;

class FiltradoExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Filtrado::select('referencia', 'descripcion', 'valor')->get();
    }
}
