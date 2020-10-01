<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Imports\ProveedorImport;
use Maatwebsite\Excel\Facades\Excel;


class ProveedorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $proveedores = App\Proveedor::orderBy('codigo')->paginate(10);
        return view('proveedor.index', compact('proveedores'));
    }
    
    public function importExcel(Request $request)
    {
        $file = $request->file('file');
        $import = new ProveedorImport();
        $import->import($file);

        if($import->failures()->isNotEmpty())
        {
            return back()->withFailures($import->failures());
        }

        return back()->with('mensaje', 'Importación de proveedores completada');
    }
}
