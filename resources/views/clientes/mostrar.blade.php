<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes - Info') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <!-- Header -->
                <div class="row page-header">
                    <div class="col-md-6">
                        <h1 class="fs-4 fw-bold">
                            <i class="bi bi-people-fill text-primary"></i>
                            Informacion del cliente
                        </h1>
                    </div>
                </div>

                <a href="{{ route('clientes.index') }}">regresar</a>
                <div class="card p-2">
                    <p><strong>Nombre: </strong>{{ $cliente->nombre }}</p>
                    <p><strong>Apellido: </strong>{{ $cliente->apellido }}</p>
                    <p><strong>Edad: </strong>{{ $cliente->edad }}</p>
                    <p><strong>Peso: </strong>{{ $cliente->peso }}</p>
                    <p><strong>Talla: </strong>{{ $cliente->talla }}</p>
                    <p><strong>Carnet: </strong>{{ $cliente->carnet }}</p>
                    <p><strong>Telefono: </strong>{{ $cliente->telefono }}</p>
                </div>
                <br>
                <div>
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
                                                                        <span
                                                                            class="badge bg-success rounded-pill px-3 py-2">
                                                                            <i class="bi bi-person-fill"></i>
                                                                            {{ $dia['cantidadIngresos'] }}
                                                                        </span>
                                                                    @endif
                                                                </div>

                                                                {{-- Lista de clientes --}}
                                                                @if ($dia['cantidadIngresos'] > 0)
                                                                    <div class="flex-grow-1 overflow-auto">
                                                                        @foreach ($dia['ingresos']->take(3) as $ingreso)
                                                                            <div class="mb-2">
                                                                                <div
                                                                                    class="d-flex align-items-center bg-success bg-opacity-10 rounded p-2">
                                                                                    <div class="avatar-sm rounded-circle bg-success text-white me-2 d-flex align-items-center justify-content-center"
                                                                                        style="width: 28px; height: 28px; font-size: 0.8rem;">
                                                                                        {{ substr($ingreso->cliente->nombre, 0, 1) }}
                                                                                    </div>
                                                                                    <small
                                                                                        class="text-truncate fw-semibold">
                                                                                        {{ Str::limit($ingreso->cliente->nombre, 12) }}
                                                                                    </small>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach

                                                                        @if ($dia['cantidadIngresos'] > 3)
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
                <br>

                <div>
                    <h2>Informacion de membresias</h2>

                    @if (count($cliente->membresias) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Rango de fechas</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Precio Pagado</th>
                                    <th scope="col">Plan </th>
                                    <th scope="col">Costo </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cliente->membresias as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ date('d/m/Y', strtotime($item->fecha_inicio)) }} al
                                            {{ date('d/m/Y', strtotime($item->fecha_fin)) }}</td>
                                        <td>{{ $item->estado }}</td>
                                        <td>{{ $item->precio_pagado }}</td>
                                        <td>{{ $item->tipomembresia->nombre }}</td>
                                        <td>{{ $item->tipomembresia->precio }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="card p-4 text-center">
                            El cliente aun no tiene membresias
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
