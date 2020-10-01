<?php

namespace App\Exports;

use App\ABC;
use App\XYZ;
use Maatwebsite\Excel\Concerns\FromCollection;

class XYZExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return XYZ::select('referencia', 'descripcion', 'media', 'desvStd', 'coefVar', 'tipo')
                    ->orderBy('tipo', 'ASC')
                    ->orderBy('media', 'DESC')
                    ->orderBy('coefVar', 'ASC')
                    ->get();
    }
}
