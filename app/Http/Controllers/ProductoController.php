<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $porPagina = $request->input('porPagina', 10);

        $query = Producto::query();

        if ($buscar) {
            $query->where(function ($q) use ($buscar) {
                $q->where('descripcion', 'LIKE', "%{$buscar}%")
                    ->orWhere('marca', 'LIKE', "%{$buscar}%")
                    ->orWhere('stock', "%{$buscar}%");
            });
        }

        $productos = $query->orderBy('created_at', 'desc')
            ->paginate($porPagina);

        return view('productos/index', compact('productos', 'buscar', 'porPagina'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos/crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $producto = new Producto($request->validate([
            'descripcion' => 'required',
            'precio' => 'required|numeric|decimal:0,2',
            'stock' => 'numeric',
            'marca' => 'required',
            'fecha_vencimiento' => 'date'
        ]));

        $producto->save();

        return redirect()->route('productos.index')->with('mensaje', 'Registrado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        return view('productos/editar', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate([
            'descripcion' => 'required',
            'precio' => 'required|numeric|decimal:0,2',
            'stock' => 'numeric',
            'marca' => 'required',
            'fecha_vencimiento' => 'date'
        ]);

        $producto->update($data);

        return redirect()->route('productos.index')->with('mensaje', 'Actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('mensaje', 'Eliminado exitosamente');
    }

    //productos
    public function pdf(){
        $data = [
            'productos' => Producto::all(),
            'user' => Auth::user()
        ];

        $pdf = Pdf::loadView('productos.pdf', $data);

        return $pdf->stream();
    }
}
