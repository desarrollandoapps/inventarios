<?php

namespace App\Exports;

use App\ABC;
use Maatwebsite\Excel\Concerns\FromCollection;

class ABCExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ABC::select('referencia', 'descripcion', 'valor', 'tipo')->get();
    }
}
