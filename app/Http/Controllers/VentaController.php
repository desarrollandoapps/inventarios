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
        $ventas = App\Venta::where('anio', 'LIKE', '%' . $query . '%')
                            ->orderBy('id', 'desc')
                            ->paginate(10);
        
        
        $date = Carbon::now();
        $date = $date->format('Y');
        $anios = [$date - 3, $date - 2, $date - 1, $date];

        return view('venta.index', compact('ventas', 'anios'));
    }

    public function insert(Request $request)
    {
        $anio = $request->anio;

        $query = App\Venta::where('anio', $anio)
                            ->first();

        if( $query )
        {
            return back()->with('error', 'Ya se ha cargado una venta para el periodo seleccionado');
        }
        
        //Guardar en tabla temporal
        $file = $request->file('file');
        $import = new DetalleTemporalImport();
        try
        {
            $import->import($file);
        } catch (\Exception $e) {
            DB::table('detalle_temporals')->delete();
            return back()->with('error', 'Error al realizar la operación de importación.' . $e->getMessage());
        }

        $total = DB::table('detalle_temporals')->sum('enero');
        $total += DB::table('detalle_temporals')->sum('febrero');
        $total += DB::table('detalle_temporals')->sum('marzo');
        $total += DB::table('detalle_temporals')->sum('abril');
        $total += DB::table('detalle_temporals')->sum('mayo');
        $total += DB::table('detalle_temporals')->sum('junio');
        $total += DB::table('detalle_temporals')->sum('julio');
        $total += DB::table('detalle_temporals')->sum('agosto');
        $total += DB::table('detalle_temporals')->sum('septiembre');
        $total += DB::table('detalle_temporals')->sum('octubre');
        $total += DB::table('detalle_temporals')->sum('noviembre');
        $total += DB::table('detalle_temporals')->sum('diciembre');

        if( $total != $request->valorTotal )
        {
            DB::table('detalle_temporals')->delete();
            return back()->with('error', 'No coincide el valor total de la venta');
        }

        //Guardar Venta
        $venta = new App\Venta;
        $venta->anio = $request->anio;
        $venta->valorTotal = $request->valorTotal;
        $venta->save();

        $numeroVenta = App\Venta::orderBy('id', 'desc')->first();
        $numeroVenta = $numeroVenta->id;

        App\DetalleTemporal::where('idVenta', null)
                            ->update(['idVenta' => $numeroVenta]);

        $detallesT = App\DetalleTemporal::orderBy('id', 'asc')->get();

        for($i = 0; $i < count($detallesT); $i++)
        {
            try {
                $detalle = $detallesT[$i];
                $detalleVenta = new App\DetalleVenta;
                $detalleVenta->enero = $detalle->enero;
                $detalleVenta->febrero = $detalle->febrero;
                $detalleVenta->marzo = $detalle->marzo;
                $detalleVenta->abril = $detalle->abril;
                $detalleVenta->mayo = $detalle->mayo;
                $detalleVenta->junio = $detalle->junio;
                $detalleVenta->julio = $detalle->julio;
                $detalleVenta->agosto = $detalle->agosto;
                $detalleVenta->septiembre = $detalle->septiembre;
                $detalleVenta->octubre = $detalle->octubre;
                $detalleVenta->noviembre = $detalle->noviembre;
                $detalleVenta->diciembre = $detalle->diciembre;
                $detalleVenta->total = $detalle->total;
                $detalleVenta->idProducto = $detalle->idProducto;
                $detalleVenta->idVenta = $detalle->idVenta;
                $detalleVenta->save();
            } catch (\Exception $e) {
                return back()->with('error', 'Error al realizar la operación.' . $e->getMessage());
            }
        }

        DB::table('detalle_temporals')->delete();

        return back()->with('mensaje', 'Importación de venta completada');

    }

    public function delete($id)
    {
        $detalles = App\DetalleVenta::where('idVenta', $id)->get();
        
        foreach ($detalles as $detalle) {
            $detalle->delete();
        }
        
        $venta = App\Venta::findorfail($id);
        $venta->delete();

        return back()->with( 'mensaje', 'Eliminación exitosa' );
    }
}
