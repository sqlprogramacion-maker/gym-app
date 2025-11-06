<x-app-layout>
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ventas') }}
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
                                Registro de Ventas
                            </h1>
                        </div>
                        <div class="col-md-6 text-end d-flex align-items-center justify-content-end">
                            @if (auth()->user()->isAdministrador())
                            @endif

                            <x-link-button :href="route('ventas.create')">
                                <i class="bi bi-plus-circle"></i> Nuevo Venta
                            </x-link-button>
                        </div>
                    </div>

                    <!-- Formulario de filtros -->
                    <div class="card filter-card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                <i class="bi bi-funnel"></i> Filtros de búsqueda
                            </h5>
                            <form action="/ventas" method="GET">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label for="buscar" class="form-label">
                                            <i class="bi bi-search"></i> Buscar
                                        </label>
                                        <input type="text" class="form-control" id="buscar" name="buscar"
                                            value="{{ $buscar }}" placeholder="Razon social">
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
                                        <a href="/ventas" class="btn btn-light">
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
                                <th scope="col">Cliente</th>
                                <th scope="col">Nit</th>
                                <th scope="col">Total</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ventas as $item)
                                <tr scope="row">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->razon_social }}</td>
                                    <td>{{ $item->nit }}</td>
                                    <td>{{ $item->total }}</td>
                                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <button >
                                         Info
                                        </button>
                                    </td>
                                </tr>
                                <!-- Fila expandible con el detalle -->
                                <tr>
                                    <td colspan="6" class="p-0">
                                        <div class="collapse" id="detalle-{{ $item->id }}">
                                            <div class="card card-body m-2">
                                                <h6 class="mb-3">Detalle de Productos - Venta #{{ $item->id }}
                                                </h6>
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Producto</th>
                                                                <th>Cantidad</th>
                                                                <th>Precio Unit.</th>
                                                                <th>Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($item->detalles as $detalle)
                                                                <tr>
                                                                    <td>{{ $detalle->producto->nombre ?? 'N/A' }}</td>
                                                                    <td>{{ $detalle->cantidad }}</td>
                                                                    <td>Bs. {{ number_format($detalle->producto->precio, 2) }}
                                                                    </td>
                                                                    <td>Bs.
                                                                        {{ number_format($detalle->cantidad * $detalle->producto->precio, 2) }}
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="4" class="text-center text-muted">
                                                                        No hay productos en esta venta
                                                                    </td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                        <tfoot>
                                                            <tr class="fw-bold">
                                                                <td colspan="3" class="text-end">Total:</td>
                                                                <td>Bs. {{ number_format($item->total, 2) }}</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div>
                        {{ $ventas->links() }}
                    </div>

                    <script>
                        function toggleIcon(button) {
                            const icon = button.querySelector('i');
                            icon.classList.toggle('bi-chevron-down');
                            icon.classList.toggle('bi-chevron-up');
                        }
                    </script>

                    <style>
                        .card-body {
                            background-color: #f8f9fa;
                            border-left: 3px solid #0dcaf0;
                        }

                        .table-responsive {
                            max-height: 400px;
                            overflow-y: auto;
                        }
                    </style>

                    <div>
                        {{ $ventas->links() }}
                    </div>
                </div>
            </body>
        </div>
</x-app-layout>
