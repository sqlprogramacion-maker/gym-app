<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
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

         return view('dashboard', compact(
            'semanas',
            'totalIngresos',
            'clientesUnicos',
            'diasActivos',
            'promedioDiario',
            'ingresosRecientes'
        ));
    }
}
