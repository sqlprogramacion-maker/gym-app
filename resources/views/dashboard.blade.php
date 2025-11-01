<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-neutral-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-white">
                    <a href="/clientes">Clientes</a>
                    <a href="/instructores">Instructores</a>
                    <a href="/equipos">Equipos</a>
                    <a href="/productos">Productos</a>

                    <a href="/tipomembresia">Tipo Membresias</a>
                    <a href="/asistencias">Asistencias</a>
                    <a href="/membresias">Membresias</a>
                </div>
            </div>
            <h2>Informacion de asistencias</h2>
            <div class="card border-0 shadow-lg mb-5">
                <div class="card-header bg-gradient text-white py-3"
                    style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <h4 class="mb-0 text-center">
                        <i class="bi bi-calendar-month"></i>
                        Calendario de Ingresos - {{ \Carbon\Carbon::now()->locale('es')->isoFormat('MMMM') }}
                    </h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0 calendario-ingresos">
                            <thead class="bg-light">
                                <tr>
                                    <th class="text-center fw-bold py-3 text-danger">Domingo</th>
                                    <th class="text-center fw-bold py-3">Lunes</th>
                                    <th class="text-center fw-bold py-3">Martes</th>
                                    <th class="text-center fw-bold py-3">Miércoles</th>
                                    <th class="text-center fw-bold py-3">Jueves</th>
                                    <th class="text-center fw-bold py-3">Viernes</th>
                                    <th class="text-center fw-bold py-3 text-primary">Sábado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semanas as $semana)
                                    <tr>
                                        @foreach ($semana as $dia)
                                            <td class="p-3 {{ $dia['mesActual'] ? '' : 'bg-light bg-opacity-50' }}"
                                                style="height: 120px; vertical-align: top; {{ $dia['esHoy'] ? 'background: linear-gradient(135deg, #667eea15 0%, #764ba215 100%);' : '' }}">
                                                @if ($dia['dia'])
                                                    <div class="d-flex flex-column h-100">
                                                        {{-- Número del día --}}
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-2">
                                                            <span
                                                                class="badge {{ $dia['esHoy'] ? 'bg-primary' : 'bg-secondary' }} rounded-pill px-3 py-2">
                                                                {{ $dia['dia'] }}
                                                            </span>
                                                            @if ($dia['cantidadIngresos'] > 0)
                                                                <span class="badge bg-success rounded-pill px-3 py-2">
                                                                    <i class="bi bi-person-fill"></i>
                                                                    {{ $dia['cantidadIngresos'] }}
                                                                </span>
                                                            @endif
                                                        </div>

                                                        {{-- Lista de clientes --}}
                                                        @if ($dia['cantidadIngresos'] > 0)
                                                            <div class="flex-grow-1 overflow-auto">
                                                                @foreach ($dia['ingresos']->take(10) as $ingreso)
                                                                    <div class="">
                                                                        <div
                                                                            class="d-flex align-items-center bg-success bg-opacity-10 rounded p-2">
                                                                            <div class="avatar-sm rounded-circle bg-success text-white me-2 d-flex align-items-center justify-content-center"
                                                                                style="width: 28px; height: 28px; font-size: 0.8rem;">
                                                                                {{ substr($ingreso->cliente->nombre, 0, 1) }}
                                                                            </div>
                                                                            <small class="text-truncate fw-semibold">
                                                                                {{ Str::limit($ingreso->cliente->nombre, 12) }}
                                                                            </small>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                                @if ($dia['cantidadIngresos'] > 10)
                                                                    <div class="text-center">
                                                                        <small class="badge bg-secondary">
                                                                            +{{ $dia['cantidadIngresos'] - 3 }}
                                                                            más
                                                                        </small>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @else
                                                            <div
                                                                class="d-flex align-items-center justify-content-center flex-grow-1">
                                                                <small class="text-muted">Sin ingresos</small>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
