<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Imports\DetalleTemporalImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = $request->buscar;
        $ventas = App\Venta::where('mes', 'LIKE', '%' . $query . '%')
                                    ->orWhere('anio', 'LIKE', '%' . $query . '%')
                                    ->orderBy('id', 'desc')->paginate(10);
        
        $date = Carbon::now();
        $date = $date->format('Y');
        $anios = [$date - 1, $date, $date + 1];

        return view('venta.index', compact('ventas', 'anios'));
    }

    public function insert(Request $request)
    {
        $anio = $request->anio;
        $mes = $request->mes;

        $query = App\Venta::where('anio', $anio)
                    ->where('mes', $mes)
                    ->first();

        if( $query )
        {
            return back()->with('error', 'Ya se ha cargado una venta para el periodo seleccionado');
        }
        //Guardar Venta
        $venta = new App\Venta;
        $venta->anio = $request->anio;
        $venta->mes = $request->mes;
        $venta->totalCajas = $request->totalCajas;
        $venta->valorTotal = $request->valorTotal;

        $numeroVenta = App\Venta::orderBy('id', 'desc')->first();
        $numeroVenta = $numeroVenta->id;
        
        // //Guardar detalles venta
        
        //Guardar en tabla temporal
        $file = $request->file('file');
        $import = new DetalleTemporalImport();
        try
        {
            $import->import($file);
        } catch (\Exception $e) {
            return back()->with('error', 'Error al realizar la operación.');
        }

        $total = DB::table('detalle_temporals')->sum('valor');
        $cantidades = DB::table('detalle_temporals')->sum('cantidad');

        if( $total != $venta->valorTotal )
        {
            return back()->with('error', 'No coincide el valor total de la venta');
        }

        if( $cantidades != $venta->cantidad )
        {
            return back()->with('error', 'No coincide el total de cajas');
        }

        $venta->save();

        App\DetalleTemporal::where('idVenta', null)
                            ->update(['idVenta' => $numeroVenta]);

        $detallesT = App\DetalleTemporal::orderBy('id', 'asc')->get();

        for($i = 0; $i < count($detallesT); $i++)
        {
            try {
                $detalle = $detallesT[$i];
                $detalleVenta = new App\DetalleVenta;
                $detalleVenta->cantidad = $detalle->cantidad;
                $detalleVenta->valor = $detalle->valor;
                $detalleVenta->idProducto = $detalle->idProducto;
                $detalleVenta->idVenta = $detalle->idVenta;
                $detalleVenta->save();
            } catch (\Exception $e) {
                return back()->with('error', 'Error al realizar la operación.');
            }
        }

        DB::table('detalle_temporals')->delete();

        return back()->with('mensaje', 'Importación de venta completada');

    }
}
