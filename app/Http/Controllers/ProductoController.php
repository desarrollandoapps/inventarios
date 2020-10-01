<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Imports\ProductoImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = $request->buscar;
        $productos = App\Producto::where('referencia', 'LIKE', '%' . $query . '%')
                                    ->orWhere('descripcion', 'LIKE', '%' . $query . '%')
                                    ->orderBy('descripcion')->paginate(10);
        return view('producto.index', compact('productos'));
    }

    public function importExcel(Request $request)
    {
        $file = $request->file('file');
        $import = new ProductoImport();
        try
        {
            $import->import($file);
            
            if ($import->failures()->isNotEmpty())
            {
                return back()->withFailures($import->failures());
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error al realizar la operación.');
        }

        return back()->with('mensaje', 'Importación de productos completada');
    }
}
