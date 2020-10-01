<?php

namespace App\Exports;

use App;
use Maatwebsite\Excel\Concerns\FromCollection;

class ABCXYZExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return App\ABC::join('x_y_z_s', 'a_b_c_s.referencia', 'x_y_z_s.referencia')
                        ->orderBy('a_b_c_s.tipo', 'ASC')
                        ->orderBy('x_y_z_s.tipo', 'ASC')
                        ->orderBy('x_y_z_s.media', 'DESC')
                        ->orderBy('x_y_z_s.coefVar', 'ASC')
                        ->select('a_b_c_s.referencia', 'a_b_c_s.descripcion', 'a_b_c_s.tipo as tipoABC', 'x_y_z_s.tipo as tipoXYZ')
                        ->get();
    }
}
