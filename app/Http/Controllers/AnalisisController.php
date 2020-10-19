<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FiltradoExport;
use App\Exports\ABCExport;
use App\Exports\XYZExport;
use App\Exports\ABCXYZExport;


class AnalisisController extends Controller
{
    public function verFiltro()
    {
        $fechas = App\Venta::select('anio')->orderBy('anio', 'ASC')->get();
        $anios = [];
        foreach ($fechas as $fecha) {
            array_push($anios, $fecha->anio);
        }
        
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
                                        ->where('detalle_ventas.total', '>=', $inferior)
                                        ->where('detalle_ventas.total', '<=', $superior)
                                        ->select('detalle_ventas.total', 'productos.referencia as codigo', 'productos.descripcion as descripcion')
                                        ->get();

        foreach ($productos as $p) {
            try {
                $filtrado = new App\Filtrado;
                $filtrado->valor = $p->total;
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

    public function verAbc()
    {
        DB::table('a_b_c_s')->delete();

        $fechas = App\Venta::select('anio')->orderBy('anio', 'ASC')->get();
        $anios = [];
        foreach ($fechas as $fecha) {
            array_push($anios, $fecha->anio);
        }
        return view('analisis.abc', compact('anios'));
    }

    public function clasificacionABC(Request $request)
    {
        $anio = $request['anio'];

        $cantidadProductos = App\DetalleVenta::join('ventas', 'detalle_ventas.idVenta', 'ventas.id')
                                    ->where('ventas.anio', $anio)
                                    ->select(DB::raw('count(*) as conteo'))
                                    ->first();
                                    
        // dd($cantidadProductos['conteo']);
        $cantidadA = round($cantidadProductos['conteo'] * 0.15);
        $cantidadB = round($cantidadProductos['conteo'] * 0.2);
        $cantidadC = round($cantidadProductos['conteo'] * 0.65);

        $productosA = App\DetalleVenta::join('ventas', 'detalle_ventas.idVenta', 'ventas.id')
                                        ->join('productos', 'detalle_ventas.idProducto', 'productos.id')
                                        ->where('ventas.anio', $anio)
                                        ->select('detalle_ventas.total', 'productos.referencia', 'productos.descripcion')
                                        ->limit($cantidadA)
                                        ->orderBy('detalle_ventas.total', 'Desc')
                                        ->get();
        $productosB = App\DetalleVenta::join('ventas', 'detalle_ventas.idVenta', 'ventas.id')
                                        ->join('productos', 'detalle_ventas.idProducto', 'productos.id')
                                        ->where('ventas.anio', $anio)
                                        ->select('detalle_ventas.total', 'productos.referencia', 'productos.descripcion')
                                        ->offset($cantidadA)
                                        ->limit($cantidadB)
                                        ->orderBy('detalle_ventas.total', 'Desc')
                                        ->get();
        $productosC = App\DetalleVenta::join('ventas', 'detalle_ventas.idVenta', 'ventas.id')
                                        ->join('productos', 'detalle_ventas.idProducto', 'productos.id')
                                        ->where('ventas.anio', $anio)
                                        ->select('detalle_ventas.total', 'productos.referencia', 'productos.descripcion')
                                        ->offset($cantidadA + $cantidadB)
                                        ->limit($cantidadC)
                                        ->orderBy('detalle_ventas.total', 'Desc')
                                        ->get();

        foreach ($productosA as $p) {
            try {
                $abc = new App\ABC;
                $abc->valor = $p->total;
                $abc->referencia = $p->referencia;
                $abc->descripcion = $p->descripcion;
                $abc->tipo = "A";
                $abc->save();
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
                // return back()->with('error', 'Error al realizar la operación.');
            }
        }
        foreach ($productosB as $p) {
            try {
                $abc = new App\ABC;
                $abc->valor = $p->total;
                $abc->referencia = $p->referencia;
                $abc->descripcion = $p->descripcion;
                $abc->tipo = "B";
                $abc->save();
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
                // return back()->with('error', 'Error al realizar la operación.');
            }
        }
        foreach ($productosC as $p) {
            try {
                $abc = new App\ABC;
                $abc->valor = $p->total;
                $abc->referencia = $p->referencia;
                $abc->descripcion = $p->descripcion;
                $abc->tipo = "C";
                $abc->save();
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
                // return back()->with('error', 'Error al realizar la operación.');
            }
        }
        return view('analisis.productos-abc', compact('anio', 'productosA', 'productosB', 'productosC'));
    }

    public function abcExportExcel()
    {
        return Excel::download(new ABCExport, 'lista-productos-abc.xlsx');
    }

    public function graficarABC()
    {
        return redirect()->route('abc.grafico');
    }
    public function graficoABC()
    {
        $productos = App\ABC::limit(500)->get();
        $vlrTotal = App\ABC::select(DB::raw('sum(valor) as vlrTotal'))->first();
        return view('analisis.grafico-abc', compact('productos', 'vlrTotal'));
    }

    public function verXyz()
    {
        DB::table('x_y_z_s')->delete();

        $fechas = App\Venta::select('anio')->orderBy('anio', 'ASC')->get();
        $anios = [];
        foreach ($fechas as $fecha) {
            array_push($anios, $fecha->anio);
        }
        // $date = Carbon::now();
        // $date = $date->format('Y');
        // $anios = [$date - 3, $date - 2, $date - 1, $date];
        return view('analisis.xyz', compact('anios'));
    }

    public function clasificacionXYZ(Request $request)
    {
        $anio = $request->anio;
        $desvStd = [];
        $medias = [];
        $cv = [];
        $clasificacion = [];

        $productos = App\DetalleVenta::join('ventas', 'detalle_ventas.idVenta', 'ventas.id')
                ->join('productos', 'detalle_ventas.idProducto', 'productos.id')
                ->select('detalle_ventas.enero','detalle_ventas.febrero','detalle_ventas.marzo','detalle_ventas.abril',
                    'detalle_ventas.mayo','detalle_ventas.junio','detalle_ventas.julio','detalle_ventas.agosto',
                    'detalle_ventas.septiembre','detalle_ventas.octubre','detalle_ventas.noviembre','detalle_ventas.diciembre',
                    'detalle_ventas.total','productos.referencia', 'productos.descripcion')
                ->where('ventas.anio', $anio)
                ->get();

        foreach ($productos as $producto) {
            $media = $producto->total / 12;
            // echo $producto->referencia . ' -> Media: ' . $media . '<br>';
            $suma = ($producto->enero - $media) * ($producto->enero - $media) +
                ($producto->febrero - $media) * ($producto->febrero - $media) +
                ($producto->marzo - $media) * ($producto->marzo - $media) +
                ($producto->abril - $media) * ($producto->abril - $media) +
                ($producto->mayo - $media) * ($producto->mayo - $media) +
                ($producto->junio - $media) * ($producto->junio - $media) +
                ($producto->julio - $media) * ($producto->julio - $media) +
                ($producto->agosto - $media) * ($producto->agosto - $media) +
                ($producto->septiembre - $media) * ($producto->septiembre - $media) +
                ($producto->octubre - $media) * ($producto->octubre - $media) +
                ($producto->noviembre - $media) * ($producto->noviembre - $media) +
                ($producto->diciembre - $media) * ($producto->diciembre - $media);
            $vari = $suma / 12;
            $sq = sqrt($vari);
            if ($media > 0)
            {
                $coefVar = $sq / $media;
            } else {
                $coefVar = 0;
            }

            array_push($medias, $media);
            array_push($desvStd, $sq);
            array_push($cv, $coefVar);
            if ($coefVar < 0.3)
            {
                array_push($clasificacion, 'X');
            } 
            elseif ($coefVar < 0.7)
            {
                array_push($clasificacion, 'Y');
            }
            else {
                array_push($clasificacion, 'Z');
            }
        }
        
        foreach ($productos as $i => $p) {
            try {
                $xyz = new App\XYZ;
                $xyz->referencia = $p->referencia;
                $xyz->descripcion = $p->descripcion;
                $xyz->media = $medias[$i];
                $xyz->desvStd = $desvStd[$i];
                $xyz->coefVar = $cv[$i];
                $xyz->tipo = $clasificacion[$i];
                $xyz->save();
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
                // return back()->with('error', 'Error al realizar la operación.');
            }
        }

        $xyz = App\XYZ::orderBy('tipo', 'ASC')
                        ->orderBy('media', 'DESC')
                        ->orderBy('coefVar', 'ASC')
                        ->get();

        return view('analisis.productos-xyz', compact('anio', 'xyz'));
    }

    public function xyzExportExcel() 
    {
        return Excel::download(new XYZExport, 'lista-productos-xyz.xlsx');
    }

    public function verAbcXyz()
    {
        DB::table('x_y_z_s')->delete();
        DB::table('a_b_c_s')->delete();

        $fechas = App\Venta::select('anio')->orderBy('anio', 'ASC')->get();
        $anios = [];
        foreach ($fechas as $fecha) {
            array_push($anios, $fecha->anio);
        }
        return view('analisis.abcxyz', compact('anios'));
    }

    public function clasificacionABCXYZ(Request $request)
    {
        $anio = $request->anio;
        $desvStd = [];
        $medias = [];
        $cv = [];
        $clasificacion = [];

        $cantidadProductos = App\DetalleVenta::join('ventas', 'detalle_ventas.idVenta', 'ventas.id')
                                    ->where('ventas.anio', $anio)
                                    ->select(DB::raw('count(*) as conteo'))
                                    ->first();
        $cantidadA = round($cantidadProductos['conteo'] * 0.15);
        $cantidadB = round($cantidadProductos['conteo'] * 0.2);
        $cantidadC = round($cantidadProductos['conteo'] * 0.65);
                            
        $productosA = App\DetalleVenta::join('ventas', 'detalle_ventas.idVenta', 'ventas.id')
                                        ->join('productos', 'detalle_ventas.idProducto', 'productos.id')
                                        ->where('ventas.anio', $anio)
                                        ->select('detalle_ventas.total', 'productos.referencia', 'productos.descripcion')
                                        ->limit($cantidadA)
                                        ->orderBy('detalle_ventas.total', 'Desc')
                                        ->get();
        $productosB = App\DetalleVenta::join('ventas', 'detalle_ventas.idVenta', 'ventas.id')
                                        ->join('productos', 'detalle_ventas.idProducto', 'productos.id')
                                        ->where('ventas.anio', $anio)
                                        ->select('detalle_ventas.total', 'productos.referencia', 'productos.descripcion')
                                        ->offset($cantidadA)
                                        ->limit($cantidadB)
                                        ->orderBy('detalle_ventas.total', 'Desc')
                                        ->get();
        $productosC = App\DetalleVenta::join('ventas', 'detalle_ventas.idVenta', 'ventas.id')
                                        ->join('productos', 'detalle_ventas.idProducto', 'productos.id')
                                        ->where('ventas.anio', $anio)
                                        ->select('detalle_ventas.total', 'productos.referencia', 'productos.descripcion')
                                        ->offset($cantidadA + $cantidadB)
                                        ->limit($cantidadC)
                                        ->orderBy('detalle_ventas.total', 'Desc')
                                        ->get();

        foreach ($productosA as $p) {
            try {
                $abc = new App\ABC;
                $abc->valor = $p->total;
                $abc->referencia = $p->referencia;
                $abc->descripcion = $p->descripcion;
                $abc->tipo = "A";
                $abc->save();
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
                // return back()->with('error', 'Error al realizar la operación.');
            }
        }
        foreach ($productosB as $p) {
            try {
                $abc = new App\ABC;
                $abc->valor = $p->total;
                $abc->referencia = $p->referencia;
                $abc->descripcion = $p->descripcion;
                $abc->tipo = "B";
                $abc->save();
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
                // return back()->with('error', 'Error al realizar la operación.');
            }
        }
        foreach ($productosC as $p) {
            try {
                $abc = new App\ABC;
                $abc->valor = $p->total;
                $abc->referencia = $p->referencia;
                $abc->descripcion = $p->descripcion;
                $abc->tipo = "C";
                $abc->save();
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
                // return back()->with('error', 'Error al realizar la operación.');
            }
        }

        $productos = App\DetalleVenta::join('ventas', 'detalle_ventas.idVenta', 'ventas.id')
                    ->join('productos', 'detalle_ventas.idProducto', 'productos.id')
                    ->select('detalle_ventas.enero','detalle_ventas.febrero','detalle_ventas.marzo','detalle_ventas.abril',
                        'detalle_ventas.mayo','detalle_ventas.junio','detalle_ventas.julio','detalle_ventas.agosto',
                        'detalle_ventas.septiembre','detalle_ventas.octubre','detalle_ventas.noviembre','detalle_ventas.diciembre',
                        'detalle_ventas.total','productos.referencia', 'productos.descripcion')
                    ->where('ventas.anio', $anio)
                    ->get();

        foreach ($productos as $producto) {
            $media = $producto->total / 12;
            // echo $producto->referencia . ' -> Media: ' . $media . '<br>';
            $suma = ($producto->enero - $media) * ($producto->enero - $media) +
                ($producto->febrero - $media) * ($producto->febrero - $media) +
                ($producto->marzo - $media) * ($producto->marzo - $media) +
                ($producto->abril - $media) * ($producto->abril - $media) +
                ($producto->mayo - $media) * ($producto->mayo - $media) +
                ($producto->junio - $media) * ($producto->junio - $media) +
                ($producto->julio - $media) * ($producto->julio - $media) +
                ($producto->agosto - $media) * ($producto->agosto - $media) +
                ($producto->septiembre - $media) * ($producto->septiembre - $media) +
                ($producto->octubre - $media) * ($producto->octubre - $media) +
                ($producto->noviembre - $media) * ($producto->noviembre - $media) +
                ($producto->diciembre - $media) * ($producto->diciembre - $media);
            $vari = $suma / 12;
            $sq = sqrt($vari);
            if ($media > 0)
            {
                $coefVar = $sq / $media;
            } else {
                $coefVar = 0;
            }

            array_push($medias, $media);
            array_push($desvStd, $sq);
            array_push($cv, $coefVar);
            if ($coefVar < 0.3)
            {
                array_push($clasificacion, 'X');
            } 
            elseif ($coefVar < 0.7)
            {
                array_push($clasificacion, 'Y');
            }
            else {
                array_push($clasificacion, 'Z');
            }
        }
            
        foreach ($productos as $i => $p) {
            try {
                $xyz = new App\XYZ;
                $xyz->referencia = $p->referencia;
                $xyz->descripcion = $p->descripcion;
                $xyz->media = $medias[$i];
                $xyz->desvStd = $desvStd[$i];
                $xyz->coefVar = $cv[$i];
                $xyz->tipo = $clasificacion[$i];
                $xyz->save();
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
                // return back()->with('error', 'Error al realizar la operación.');
            }
        }

        $full = App\ABC::join('x_y_z_s', 'a_b_c_s.referencia', 'x_y_z_s.referencia')
                        ->orderBy('a_b_c_s.tipo', 'ASC')
                        ->orderBy('x_y_z_s.tipo', 'ASC')
                        ->orderBy('x_y_z_s.media', 'DESC')
                        ->orderBy('x_y_z_s.coefVar', 'ASC')
                        ->select('x_y_z_s.tipo as tipoXYZ', 'a_b_c_s.referencia', 'a_b_c_s.descripcion', 'a_b_c_s.tipo as tipoABC')
                        ->get();

        return view('analisis.productos-abcxyz', compact('anio', 'full'));
    
    }

    public function fullExportExcel() 
    {
        return Excel::download(new ABCXYZExport, 'lista-productos-abcxyz.xlsx');
    }

    public function verRecomendaciones()
    {
        return view('analisis.recomendaciones');
        
        // $full = App\ABC::join('x_y_z_s', 'a_b_c_s.referencia', 'x_y_z_s.referencia')
        //                 ->select('x_y_z_s.tipo as tipoXYZ', 'a_b_c_s.referencia', 'a_b_c_s.descripcion', 'a_b_c_s.tipo as tipoABC')
        //                 ->get();
            
        // $multiproducto = App\ABC::join('productos', 'a_b_c_s.referencia', 'productos.referencia')
        //                         ->join('proveedors', 'productos.idProveedor', 'proveedors.id')
        //                         ->select('proveedors.id as idProveedor', 'a_b_c_s.referencia', 'a_b_c_s.descripcion', 'a_b_c_s.tipo', 'proveedors.nombre as proveedor')
        //                         ->where('a_b_c_s.tipo', 'A')
        //                         ->orWhere('a_b_c_s.tipo', 'B')
        //                         ->orderBy('proveedors.nombre', 'asc')
        //                         ->orderBy('a_b_c_s.tipo', 'ASC')
        //                         ->get();

        // $comunes = array();
        // $productos = array();
        // $pos = 0;
        // for ($i = 0; $i < count($multiproducto) - 1; $i++) {
        //     $producto1 = $multiproducto[$i];
        //     $producto2 = $multiproducto[$i + 1];

        //     if($producto1->idProveedor == $producto2->idProveedor)
        //     {
        //         // echo $producto1;
        //         $productos[] = $producto1;
        //     }
        //     else
        //     {
        //         $comunes[$pos] = $productos;
        //         $pos++;
        //         $productos = array();
        //     }
        // }
        
        // foreach ($comunes[0] as $item) {
        //     echo $item['descripcion'] . "<br>";
        // }

        // return view('analisis.recomendaciones', compact('comunes'));

                                
        // echo $multiproducto;
        
        // $full[0]["otro"] = "otro";
        // echo $full[0];

    }
    
}