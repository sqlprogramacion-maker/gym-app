<x-app-layout>
    {{-- <style>
        input {
            border-radius: 1em;
        }
        body {
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .filter-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            margin-bottom: 1.5rem;
        }

        .filter-card .form-label {
            color: white;
            font-weight: 500;
        }

        .filter-card .form-control,
        .filter-card .form-select {
            border: 1px solid rgba(255, 255, 255, 0.3);
            background-color: rgba(255, 255, 255, 0.9);
        }

        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .results-info {
            font-size: 0.9rem;
            color: #6c757d;
        } --}}
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Membresias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <body>
                <div class="container">
                    <!-- Header -->
                    <div class="row page-header">
                        <div class="col-md-6">
                            <h1 class="fs-4 fw-bold">
                                <i class="bi bi-people-fill text-primary"></i>
                                Gestión de Membresias
                            </h1>
                        </div>
                        <div class="col-md-6 text-end d-flex align-items-center justify-content-end">
                            <a href="/membresias/create" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Asignar Membresia
                            </a>
                        </div>
                    </div>

                    <!-- Formulario de filtros -->
                    <div class="card filter-card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                <i class="bi bi-funnel"></i> Filtros de búsqueda
                            </h5>
                            <form action="/membresias" method="GET">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="buscar" class="form-label">
                                            <i class="bi bi-search"></i> Buscar
                                        </label>
                                        <input type="text" class="form-control" id="buscar" name="buscar"
                                            value="{{ $buscar }}" placeholder="Nombre">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="estado" class="form-label">
                                            <i class="bi bi-toggle-on"></i> Estado
                                        </label>
                                        <select class="form-select" id="estado" name="estado">
                                            <option value="">Todos los estados</option>
                                            <option value="1">Activo</option>
                                            <option value="0">Inactivo</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="per_page" class="form-label">
                                            <i class="bi bi-list-ol"></i> Registros
                                        </label>
                                        <select class="form-select" id="porPagina" name="porPagina">
                                            <option value="10" @selected($porPagina == 10)>10</option>
                                            <option value="25" @selected($porPagina == 25)>25</option>
                                            <option value="50" @selected($porPagina == 50)>50</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 d-flex align-items-end gap-2">
                                        <button type="submit" class="btn btn-light flex-fill">
                                            <i class="bi bi-search"></i> Buscar
                                        </button>
                                        <a href="/membresias" class="btn btn-light">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table mt-2">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Carnet</th>
                                <th scope="col">Membresia</th>
                                <th scope="col">Duracion (meses)</th>
                                <th scope="col">Precio pagado</th>
                                <th scope="col">Total</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($membresias as $item)
                                <tr scope="row">
                                    <td>
                                        {{ $item->id }}
                                    </td>
                                    <td>
                                        {{ $item->cliente->apellido }}
                                    </td>
                                    <td>
                                        {{ $item->cliente->carnet }}
                                    </td>
                                     <td>
                                        {{ $item->tipomembresia->nombre }}
                                    </td>
                                   
                                    <td>
                                        {{ $item->tipomembresia->meses }}
                                    </td>
                                    <td>
                                        {{ $item->precio_pagado }}
                                    </td>
                                     <td>
                                        {{ $item->tipomembresia->precio }}
                                    </td>
                                     <td>
                                        {{ $item->estado }}
                                    </td>
                                    <td class="flex gap-2 items-center">
                                        <a href="{{ route('clientes.edit', $item) }}">mostrar</a>
                                        <a href="">pagar</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <div>
                        {{ $membresias->links() }}
                    </div>
                </div>
            </body>
        </div>
</x-app-layout>
nombre
