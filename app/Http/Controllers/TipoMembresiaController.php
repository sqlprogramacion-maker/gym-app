<?php

namespace App\Http\Controllers;

use App\Models\TipoMembresia;
use Illuminate\Http\Request;

class TipoMembresiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $porPagina = $request->input('porPagina', 10);

        $query = TipoMembresia::query();

        if ($buscar) {
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre', 'LIKE', "%{$buscar}%");
            });
        }

        $tipoMembresias = $query->orderBy('created_at', 'desc')
            ->paginate($porPagina);

        return view('tipomembresias/index', compact('tipoMembresias', 'buscar', 'porPagina'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipomembresias/crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tipoMembresia = new TipoMembresia($request->validate([
            'nombre' => 'required',
            'meses' => 'required|numeric',
            'precio' => 'required|numeric|decimal:0,2',
            'beneficios' => 'string'
        ]));

        $tipoMembresia->save();

        return redirect()->route('tipomembresia.index')->with('mensaje', 'Registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoMembresia $tipoMembresia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoMembresia $tipomembresia)
    {
        return view('tipomembresias/editar', compact('tipomembresia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoMembresia $tipomembresia)
    {
        $datos = $request->validate([
            'nombre' => 'required',
            'meses' => 'required|numeric',
            'precio' => 'required|numeric|decimal:0,2',
            'beneficios' => 'string'
        ]);

        $tipomembresia->update($datos);

        return redirect()->route('tipomembresia.index')->with('mensaje', 'Actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $tipoMembresia = TipoMembresia::findOrFail($id);
        $tipoMembresia->delete();

        return redirect()->route('tipomembresia.index')->with('mensaje', 'Eliminado exitosamente.');
    }
}
