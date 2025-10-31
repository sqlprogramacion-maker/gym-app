<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $clientes = Cliente::where('carnet', $buscar)->orWhere('id', "{$buscar}")->get();

        $asistencias = Asistencia::whereDate('fecha', today())->get();

        return view('asistencias/index', compact('asistencias', 'clientes', 'buscar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $asistencia = new Asistencia($request->validate([
            'cliente_id' => 'required|integer'
        ]));

        // Verificar si existe un registro de hoy
        $existe = Asistencia::whereDate('fecha', now())->where('cliente_id', $asistencia->cliente_id)->exists();

        if ($existe) {
            return back()->with('error', 'Ya existe un registro para hoy');
        }
        
        $asistencia->user_id = Auth::id();
        $asistencia->fecha = now();

        $asistencia->save();

        return redirect()->route('asistencias.index')->with('mensaje', 'Registrado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asistencia $asistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asistencia $asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asistencia $asistencia)
    {
        //
    }
}
