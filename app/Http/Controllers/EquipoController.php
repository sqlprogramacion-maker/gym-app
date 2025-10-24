<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipoController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $porPagina = $request->input('porPagina', 10);

        $query = Equipo::query();

        if($buscar){
            $query->where(function($q) use ($buscar){
                $q->where('descripcion', 'LIKE', "%{$buscar}%")
                ->orWhere('marca', 'LIKE', "%{$buscar}%");
            });
        }

        $equipos = $query->orderBy('created_at', 'desc')
            ->paginate($porPagina);

        return view('equipos/index', compact('equipos', 'buscar', 'porPagina'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('equipos/crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $equipo = new Equipo($request->validate([
            'descripcion' => 'required|string',
            'marca' => 'required',
            'fecha_compra' => 'date',
            'estado' => '',
            'ultimo_mantenimiento' => 'nullable|date',
        ]));

        $equipo->user_id = Auth::id();

        $equipo->save();

        return redirect()->route('equipos.index')->with('mensaje', 'Registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipo $equipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipo $equipo)
    {
        return view('equipos/editar', compact('equipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Equipo $equipo)
    {
        $data = $request->validate([
            'descripcion' => 'required|string',
            'marca' => 'required',
            'fecha_compra' => 'date',
            'estado' => '',
            'ultimo_mantenimiento' => 'date',
        ]);

        $equipo->update($data);

        return redirect()->route('equipos.index')->with('mensaje', 'Actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $equipo = Equipo::findOrFail($id);
        $equipo->delete();

        return redirect()->route('equipos.index')->with('mensaje', 'Eliminado exitosamente');
    }
}
