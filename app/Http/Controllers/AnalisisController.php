<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FiltradoExport;


class AnalisisController extends Controller
{
    public function verFiltro()
    {
        $date = Carbon::now();
        $date = $date->format('Y');
        $anios = [$date - 3, $date - 2, $date - 1, $date, $date + 1];
        
        DB::table('filtrados')->delete();
        
        return view('analisis.filtro', compact('anios'));
    }

    public function filtrar(Request $request)
    {

        $anio = $request['anio'];
        $inferior = $request['inferior'];
        $superior = $request['superior'];

        $productos = App\DetalleVenta::join('ventas', 'detalle_ventas.idVenta', 'ventas.id')
                                        ->join('productos', 'detalle_ventas.idProducto', 'productos.id')
                                        ->where('ventas.anio', $anio)
                                        ->where('detalle_ventas.valor', '>=', $inferior)
                                        ->where('detalle_ventas.valor', '<=', $superior)
                                        ->select('detalle_ventas.valor', 'productos.referencia as codigo', 'productos.descripcion as descripcion')
                                        ->get();

        foreach ($productos as $p) {
            try {
                $filtrado = new App\Filtrado;
                $filtrado->valor = $p->valor;
                $filtrado->referencia = $p->codigo;
                $filtrado->descripcion = $p->descripcion;
                $filtrado->save();
            } catch (\Exception $e) {
                return back()->with('error', 'Error al realizar la operación.');
            }
        }
        
        return view( 'analisis.filtrado', compact('productos', 'anio', 'inferior', 'superior') );
    }

    public function filtradoExportExcel()
    {
        return Excel::download(new FiltradoExport, 'lista-productos-filtrados.xlsx');
    }

    public function abc()
    {
        
    }
}
