<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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
        if ($buscar) {
            $query->where(function ($q) use ($buscar) {
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
        // Obtener mes y año actual
        $mesActual = Carbon::now()->month;
        $anioActual = Carbon::now()->year;

        // Primer y último día del mes
        $primerDia = Carbon::now()->startOfMonth();
        $ultimoDia = Carbon::now()->endOfMonth();

        // Obtener todas las asistencias del mes actual
        $ingresosMes = Asistencia::with('cliente')
            ->whereYear('fecha', $anioActual)
            ->whereMonth('fecha', $mesActual)
            ->orderBy('fecha', 'desc')
            ->get();

        // Agrupar ingresos por día
        $ingresosPorDia = $ingresosMes->groupBy(function ($ingreso) {
            return Carbon::parse($ingreso->fecha)->day;
        });

        // Construir el calendario
        $semanas = [];
        $diaActual = $primerDia->copy()->startOfWeek(Carbon::SUNDAY);

        while ($diaActual <= $ultimoDia->endOfWeek(Carbon::SUNDAY)) {
            $semana = [];

            for ($i = 0; $i < 7; $i++) {
                $esMesActual = $diaActual->month == $mesActual;
                $dia = $esMesActual ? $diaActual->day : null;
                $ingresosDia = $esMesActual && isset($ingresosPorDia[$dia])
                    ? $ingresosPorDia[$dia]
                    : collect([]);

                $semana[] = [
                    'dia' => $dia,
                    'fecha' => $diaActual->copy(),
                    'mesActual' => $esMesActual,
                    'esHoy' => $diaActual->isToday(),
                    'cantidadIngresos' => $ingresosDia->count(),
                    'ingresos' => $ingresosDia
                ];

                $diaActual->addDay();
            }

            $semanas[] = $semana;

            if ($diaActual > $ultimoDia->endOfWeek(Carbon::SUNDAY)) {
                break;
            }
        }

        // Calcular estadísticas
        $totalIngresos = $ingresosMes->count();
        $clientesUnicos = $ingresosMes->pluck('cliente_id')->unique()->count();
        $diasActivos = $ingresosPorDia->count();
        $promedioDiario = $diasActivos > 0 ? $totalIngresos / $diasActivos : 0;

        // Obtener los 10 ingresos más recientes
        $ingresosRecientes = $ingresosMes->take(10);

        return view('clientes/mostrar', compact(
            'cliente',
            'semanas',
            'totalIngresos',
            'clientesUnicos',
            'diasActivos',
            'promedioDiario',
            'ingresosRecientes'
        ));
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

    //generar reporte
    public function pdf(){
        $data = [
            'user' => Auth::user(),
            'clientes' => Cliente::all()
        ];
        
        $pdf = Pdf::loadView('clientes.pdf', $data);

        return $pdf->stream();
    }
}
