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
                                            <option value="pendiente" @selected($estado == 'pendiente')>Pendiente</option>
                                            <option value="activo"  @selected($estado == 'activo')>Inactivo</option>
                                            <option value="cancelado"  @selected($estado == 'cancelado')>Cancelado</option>
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
                                        <button type="button" class="btn-info-modal" data-id="{{ $item->id }}"
                                            data-nombre="{{ $item->cliente->nombre }}"
                                            data-apellido="{{ $item->cliente->apellido }}"
                                            data-edad="{{ $item->cliente->edad }}"
                                            data-peso="{{ $item->cliente->peso }}"
                                            data-carnet="{{ $item->cliente->carnet }}"
                                            data-telefono="{{ $item->cliente->telefono }}"
                                            data-talla="{{ $item->cliente->talla }}"
                                            data-mnombre="{{ $item->tipomembresia->nombre }}"
                                            data-mmeses="{{ $item->tipomembresia->meses }}"
                                            data-mprecio="{{ $item->tipomembresia->precio }}"
                                            data-mbeneficios="{{ $item->tipomembresia->beneficios }}"
                                            data-fechainicio="{{ $item->fecha_inicio }}"
                                            data-fechafin="{{ $item->fecha_fin }}"
                                            data-estado="{{ $item->estado }}"
                                            data-preciopagado="{{ $item->precio_pagado }}"
                                            >
                                            <i class="bi bi-info-circle"></i> Info
                                        </button>
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

                <!-- MODAL INFO -->
                <div class="modal fade" id="modalInfo" tabindex="-1" aria-labelledby="modalInfoLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalInfoLabel">Información Detallada</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Datos del cliente</strong></p>
                                        <p><strong>ID:</strong> <span id="modal-id"></span></p>
                                        <p><strong>Nombre:</strong> <span id="modal-nombre"></span></p>
                                        <p><strong>Apellido:</strong> <span id="modal-apellido"></span></p>
                                        <p><strong>Edad:</strong> <span id="modal-edad"></span></p>
                                        <p><strong>Peso:</strong> <span id="modal-peso"></span> Kg</p>
                                        <p><strong>Carnet:</strong> <span id="modal-carnet"></span></p>
                                        <p><strong>Telefono:</strong> <span id="modal-telefono"></span></p>
                                        <p><strong>Talla:</strong> <span id="modal-talla"></span> cm</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Datos de la membresia</strong></p>
                                        <p><strong>Membresia:</strong> <span id="modal-mnombre"></span></p>
                                        <p><strong>Duracion:</strong> <span id="modal-mmeses"></span></p>
                                        <p><strong>Precio:</strong> <span id="modal-mprecio"></span></p>
                                        <p><strong>Beneficios:</strong> <span id="modal-mbeneficios"></span></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Membresia y estado de pago</strong> </p>
                                        <p><strong>Fecha inicio:</strong> <span id="modal-fechainicio"></span></p>
                                        <p><strong>Fecha fin:</strong> <span id="modal-fechafin"></span></p>
                                        <p><strong>Estado:</strong> <span id="modal-estado"></span></p>
                                        <p><strong>Fecha precio pagado:</strong> <span id="modal-preciopagado"></span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </body>
        </div>
        
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const botonesInfo = document.querySelectorAll('.btn-info-modal');
            const modal = new bootstrap.Modal(document.getElementById('modalInfo'));

            botonesInfo.forEach(boton => {
                boton.addEventListener('click', function() {
                    document.getElementById('modal-id').textContent = this.dataset.id;
                    document.getElementById('modal-nombre').textContent = this.dataset.nombre;
                    document.getElementById('modal-apellido').textContent = this.dataset.apellido;
                    document.getElementById('modal-edad').textContent = this.dataset.edad;
                    document.getElementById('modal-peso').textContent = this.dataset.peso;
                    document.getElementById('modal-carnet').textContent = this.dataset.carnet;
                    document.getElementById('modal-telefono').textContent = this.dataset.telefono;
                    document.getElementById('modal-talla').textContent = this.dataset.talla;
                    document.getElementById('modal-mnombre').textContent = this.dataset.mnombre;
                    document.getElementById('modal-mmeses').textContent = this.dataset.mmeses;
                    document.getElementById('modal-mprecio').textContent = this.dataset.mprecio;
                    document.getElementById('modal-mbeneficios').textContent = this.dataset.mbeneficios;
                    document.getElementById('modal-fechainicio').textContent = this.dataset.fechainicio;
                    document.getElementById('modal-fechafin').textContent = this.dataset.fechafin;
                    document.getElementById('modal-estado').textContent = this.dataset.estado;
                    document.getElementById('modal-preciopagado').textContent = this.dataset.preciopagado;


                    modal.show();
                });
            });
        });
    </script>
</x-app-layout>
