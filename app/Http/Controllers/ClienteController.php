<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $estado = $request->input('estado');
        $porPagina = $request->input('porPagina', 10);

        //Query del cliente
        $query = Cliente::query();

        // Aplicar filtros de busqueda si existen
        if($buscar){
            $query->where(function($q) use ($buscar){
                $q->where('nombre', 'LIKE', "%{$buscar}%")
                ->orWhere('apellido', 'LIKE', "%{$buscar}%")
                ->orWhere('carnet', 'LIKE', "%{$buscar}%")
                ->orWhere('telefono', 'LIKE', "%{$buscar}%");
            });
        }

        // Aplicar filtro de estado
        $clientes = $query->orderBy('created_at', 'desc')
            ->paginate($porPagina);

        return view('clientes/index', compact('clientes', 'buscar', 'porPagina'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes/crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cliente = new Cliente($request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'edad' => 'int',
            'peso' => 'int',
            'carnet' => 'int',
            'telefono' => 'int',
            'talla' => 'int',
        ]));

        $cliente->user_id = Auth::id();

        $cliente->save();

        return redirect()->route('clientes.index')->with('mensaje', 'Cliente registrado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes/editar', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $validateData = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'edad' => 'int',
            'peso' => 'int',
            'carnet' => 'int',
            'telefono' => 'int',
            'talla' => 'int',
        ]);

        $cliente->update($validateData);

        return redirect()->route('clientes.index')->with('mensaje', 'Actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('mensaje', 'Cliente eliminado');
    }
}
