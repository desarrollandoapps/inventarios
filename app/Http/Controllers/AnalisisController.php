<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AnalisisController extends Controller
{
    public function verFiltro()
    {
        $date = Carbon::now();
        $date = $date->format('Y');
        $anios = [$date - 3, $date - 2, $date - 1, $date, $date + 1];

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

        return view( 'analisis.filtrado', compact('productos', 'anio', 'inferior', 'superior') );
        // return redirect()->route( 'analisis.filtrado', compact('productos') );
    }

    public function filtrado()
    {

    }
}
