<?php

namespace App\Http\Controllers;

use App\Models\Membresia;
use App\Models\Pago;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        try {
            $request->validate([
                'fecha' => 'required|date',
                'monto' => 'required|numeric',
                'membresia_id' => 'required|numeric'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        }

        Pago::create([
            'fecha' => $request->fecha,
            'monto' => $request->monto,
            'membresia_id' => $request->membresia_id,
            'user_id' => Auth::id()
        ]);

        $membresia = Membresia::findOrFail($request->membresia_id);

        $membresia->update([
            'precio_pagado' => $membresia->precio_pagado + $request->monto
        ]);

        return response()->json([
            'message' => 'Registro guardado exitosamente'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        //
    }
}
