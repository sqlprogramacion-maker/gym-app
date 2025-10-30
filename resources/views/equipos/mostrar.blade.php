<x-app-layout>
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Equipos - Info') }}
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
                                Equipo
                            </h1>
                        </div>
                    </div>

                    <div>
                        <div>
                            <h1><strong>Informacion del equipo</strong></h1>
                            <p><strong>Descripcion: </strong>{{ $equipo->descripcion }}</p>
                            <p><strong>Marca: </strong>{{ $equipo->marca }}</p>
                            <p><strong>Fecha compra: </strong>{{ $equipo->fecha_compra }}</p>
                            <p><strong>Estado: </strong>{{ $equipo->estado }}</p>
                            <p><strong>Registrado por: </strong>{{ $equipo->user->name }}</p>
                        </div>
                        <br>
                        <div><a href="/equipos">Regresar</a> <button id="openModalMantenimiento" class="btn btn-primary">Registrar Mantenimiento</button>
                        </div>
                        <h2><strong>Historial de mantenimiento</strong></h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">costo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipo->mantenimientos as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->descripcion }}</td>
                                        <td>{{ $item->fecha }}</td>
                                        <td>{{ $item->costo }} Bs.</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </body>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Registrar mantenimiento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('equipos.mantenimiento.store', $equipo->id) }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripcion</label>
                            <textarea class="form-control" id="descripcion" rows="3" name="descripcion">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="costo" class="form-label">Costo</label>
                            <input type="text" class="form-control" name="costo" id="costo" placeholder="costo"
                                value="{{ old('costo') }}">
                            @error('costo')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tipo_mantenimiento" class="form-label">Tipo Mantenimiento</label>
                            <select class="form-select" aria-label="Default select example" id="estado"
                                name="tipo_mantenimiento">
                                <option selected>Selecciona el tipo</option>
                                <option value="0">Preventivo</option>
                                <option value="1">Correctivo</option>
                            </select>
                            @error('tipo_mantenimiento')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha Mantenimiento</label>
                            <input type="date" class="form-control" name="fecha" id="fecha"
                                value="{{ old('fecha') }}">
                            @error('fecha')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="cliente_id" id="cliente_id"
                                value="{{ old('cliente_id', $equipo->id) }}" style="display: none">
                        </div>
                        <div>
                            <button type="submit">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openModalButton = document.getElementById('openModalMantenimiento');
            const myModalElement = document.getElementById('myModal');
            const myModal = new bootstrap.Modal(myModalElement);

            openModalButton.addEventListener('click', function() {
                myModal.show();
            });
        });
    </script>
</x-app-layout>
