<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $porPagina = $request->input('porPagina', 10);

        $query = Instructor::query();

        if($buscar){
            $query->where(function($q) use ($buscar){
                $q->where('nombre', 'LIKE', "%{$buscar}%")
                ->orWhere('apellido', 'LIKE', "%{$buscar}%")
               ->orWhere('carnet', 'LIKE', "%{$buscar}%");
            });
        }

        $instructores = $query->orderBy('created_at', 'desc')
            ->paginate($porPagina);

        return view('instructores/index', compact('instructores', 'buscar', 'porPagina'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('instructores/crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $instructor = new Instructor($request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'especialidad' => 'required',
            'celular' => 'int',
            'carnet' => 'int',
            'direccion' => 'string'
        ]));

        $instructor->save();

        return redirect()->route('instructores.index')->with('mensaje', 'Registrado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Instructor $instructor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instructor $instructor)
    {
        return view('instructores/editar', compact('instructor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instructor $instructor)
    {
        $validatedData = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'especialidad' => 'required',
            'celular' => 'int',
            'carnet' => 'int',
            'direccion' => 'string'
        ]);

        $instructor->update($validatedData);

        return redirect()->route('instructores.index')->with('mensaje', 'Actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $instructor = Instructor::findOrFail($id);

        $instructor->delete();

        return redirect()->route('instructores.index')->with('mensaje', 'Eliminado exitosamente');
    }
}
