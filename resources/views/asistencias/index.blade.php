<x-app-layout>
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
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
                                <i class="bi bi-collection-fill"></i>
                                Registro de Asistencias
                            </h1>
                        </div>
                    </div>

                    <!-- Formulario de filtros -->
                    <div class="card filter-card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                <i class="bi bi-funnel"></i> Filtros de búsqueda
                            </h5>
                            <form action="/asistencias" method="GET">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="buscar" class="form-label">
                                            <i class="bi bi-search"></i> Buscar
                                        </label>
                                        <input type="text" class="form-control" id="buscar" name="buscar"
                                            value="{{ $buscar }}" placeholder="Carnet o codigo">
                                    </div>

                                    {{-- <div class="col-md-3">
                                        <label for="estado" class="form-label">
                                            <i class="bi bi-toggle-on"></i> Estado
                                        </label>
                                        <select class="form-select" id="estado" name="estado">
                                            <option value="">Todos los estados</option>
                                            <option value="1">Activo</option>
                                            <option value="0">Inactivo</option>
                                            <option value="0">Inactivo</option>
                                        </select>
                                    </div> --}}

                                    <div class="col-md-3 d-flex align-items-end gap-2">
                                        <button type="submit" class="btn btn-light flex-fill">
                                            <i class="bi bi-search"></i> Buscar
                                        </button>
                                        <a href="/asistencias" class="btn btn-light">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (count($clientes) > 0)
                        <div class="card p-2">
                            @foreach ($clientes as $index => $cliente)
                                @if ($index === 0)
                                    {{-- Aquí va el código para renderizar el primer objeto --}}
                                    <div>
                                        <p><strong>Nombre: </strong> {{ $cliente->nombre }}</p>
                                        <p><strong>Apellido: </strong> {{ $cliente->apellido }}</p>
                                        <p><strong>Edad: </strong> {{ $cliente->edad }}</p>
                                        <p><strong>Peso: </strong> {{ $cliente->peso }}</p>
                                        <p><strong>Carnet: </strong> {{ $cliente->carnet }}</p>
                                        <p><strong>Telefono: </strong> {{ $cliente->telefono }}</p>
                                        <p><strong>Talla: </strong> {{ $cliente->talla }}</p>
                                    </div>
                                    <div>
                                        <form action="{{ route('asistencias.store') }}" method="post">
                                            @csrf
                                            <input type="number" name="cliente_id" value="{{ $cliente->id }}"
                                                style="display: none">
                                            <x-primary-button>REGISTRAR INGRESO</x-primary-button>

                                        </form>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif


                    <div class="mt-2">Registro de ingresos del dia</div>
                    <table class="table mt-2">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Edad (Bs)</th>
                                <th scope="col">Carnet</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asistencias as $item)
                                <tr scope="row">
                                    <td>
                                        {{ $item->id }}
                                    </td>
                                    <td>
                                        {{ $item->cliente->nombre }}
                                    </td>
                                    <td>
                                        {{ $item->cliente->apellido }}
                                    </td>
                                    <td>
                                        {{ $item->cliente->edad }}
                                    </td>
                                    <td>
                                        {{ $item->cliente->carnet }}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>



            </body>
        </div>
</x-app-layout>
