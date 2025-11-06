<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $porPagina = $request->input('porPagina', 10);

        //Query del cliente
        $query = Venta::query();

        // Aplicar filtros de busqueda si existen
        if ($buscar) {
            $query->where(function ($q) use ($buscar) {
                $q->where('razon_social', 'LIKE', "%{$buscar}%");
            });
        }

        // Aplicar filtro de estado
        $ventas = $query->orderBy('created_at', 'desc')
            ->paginate($porPagina);

        return view('ventas/index', compact('ventas', 'buscar', 'porPagina'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        $clientes = Cliente::all();
        return view('ventas.crear', compact('productos', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'cliente_id' => 'required',
            'productos' => 'required'
        ]);

        $cliente = Cliente::findOrFail($request->cliente_id);

        if (is_null($request->razon_social) || isNull($request->nit)) {
            $venta = Venta::create([
                'cliente_id' => $request->cliente_id,
                'razon_social' => $cliente->nombre,
                'nit' => $cliente->carnet,
                'total' => $request->total,
                'user_id' => Auth::user()->id,
            ]);
        } else {
            $venta = Venta::create([
                'cliente_id' => $request->cliente_id,
                'razon_social' => $request->razon_social,
                'nit' => $request->nit,
                'total' => $request->total,
                'user_id' => Auth::user()->id,
            ]);
        }

        foreach ($request->productos as $detalle) {
            $venta->detalles()->create([
                'producto_id' => $detalle['id'],
                'cantidad' => $detalle['cantidad'],
                'precio' => $detalle['precio'],
                'subtotal' => $detalle['subtotal'],
            ]);

            // Restar el stock
            Producto::where('id', $detalle['id'])
                ->decrement('stock', $detalle['cantidad']);
        }

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
