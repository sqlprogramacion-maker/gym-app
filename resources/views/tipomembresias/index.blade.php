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
                                Gestión de Membresias
                            </h1>
                        </div>
                        <div class="col-md-6 text-end d-flex align-items-center justify-content-end">
                             <x-link-button :href="route('tipomembresia.create')">
                                 <i class="bi bi-plus-circle"></i> Nuevo Membresia
                            </x-link-button>
                        </div>
                    </div>

                    <!-- Formulario de filtros
                    <div class="card filter-card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                <i class="bi bi-funnel"></i> Filtros de búsqueda
                            </h5>
                            <form action="/tipomembresia" method="GET">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="buscar" class="form-label">
                                            <i class="bi bi-search"></i> Buscar
                                        </label>
                                        <input type="text" class="form-control" id="buscar" name="buscar"
                                            value="{{ $buscar }}" placeholder="Descripcion o marca">
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
                                        <a href="/productos" class="btn btn-light">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> -->

                    <table class="table mt-2">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Duracion (meses)</th>
                                <th scope="col">Precio (Bs)</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipoMembresias as $item)
                                <tr scope="row">
                                    <td>
                                        {{ $item->id }}
                                    </td>
                                    <td>
                                        {{ $item->nombre }}
                                    </td>
                                    <td>
                                        {{ $item->meses }}
                                    </td>
                                    <td>
                                        {{ $item->precio }}
                                    </td>
                                    <td class="flex gap-6">
                                        <a href="{{ route('tipomembresia.edit', $item) }}">editar</a>
                                        <form action="{{ route('tipomembresia.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div>
                        {{ $tipoMembresias->links() }}
                    </div>
                </div>
            </body>
        </div>
</x-app-layout>
