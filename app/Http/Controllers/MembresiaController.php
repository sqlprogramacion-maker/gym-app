<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Membresia;
use App\Models\TipoMembresia;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MembresiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $estado = $request->input("estado");
        $porPagina = $request->input('porPagina', 10);

        //Query del cliente
        //$query = Membresia::query();
        $query = Membresia::with('cliente');

        // Aplicar filtros de busqueda si existen
        if($buscar){
            $query->whereHas('cliente', function ($q) use ($request) {
                $q->where('apellido', 'like', '%' . $request->buscar . '%')
                  ->orWhere('carnet', 'like', '%' . $request->buscar . '%')
                  ;
            });
        }

        if($estado){
            $query->where('estado', $estado);
        }
        // Aplicar filtro de estado
        $membresias = $query->orderBy('created_at', 'desc')
            ->paginate($porPagina);

        return view('membresias/index', compact('membresias', 'buscar', 'estado', 'porPagina'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $tipomembresias = TipoMembresia::all();
        return view('membresias/crear', compact('clientes', 'tipomembresias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $membresia = new Membresia($request->validate([
            'fecha_inicio' => 'required|date',
            'precio_pagado' => 'numeric|decimal:0,2',
            'tipomembresia_id' => 'required|integer',
            'cliente_id' => 'required|integer'
        ]));

        
        $tipomembresia = TipoMembresia::findOrFail($membresia->tipomembresia_id);

        $membresia->fecha_fin = Carbon::parse($membresia->fecha_inicio)->addMonths($tipomembresia->meses);

        if($membresia->precio_pagado == $tipomembresia->precio){
            $membresia->estado = 'activo';
        }

        $membresia->save();

        return redirect()->route('membresias.index')->with('mensaje', 'Asignado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Membresia $membresia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membresia $membresia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Membresia $membresia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membresia $membresia)
    {
        //
    }
}
