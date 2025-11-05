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
                        <div>
                            <a href="/equipos">Regresar</a>

                            <button type="button" class="btn-modal underline" data-bs-toggle="modal" data-bs-target="#formModal">
                                Registrar Mantenimiento
                            </button>
                        </div>
                        <h2><strong>Historial de mantenimiento</strong></h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">costo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipo->mantenimientos as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ $item->descripcion }}</td>
                                        <td>{{ $item->tipo_mantenimiento }}</td>
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


    <!-- Modal -->
    <div class="modal fade" id="formModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Datos Adicionales</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="registroMantenimientoForm">
                    <div id="error-message" class="alert alert-danger" style="display: none;">
                        <strong id="error-title"></strong>
                        <ul id="error-list"></ul>
                    </div>
                    <div class="modal-body">
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
                                <option value="preventivo">Preventivo</option>
                                <option value="correctivo">Correctivo</option>
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('registroMantenimientoForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Evita el envío tradicional del formulario

            const formulario = e.target;
            // 1. CAPTURAR DATOS
            const datos = new FormData(formulario);

            // **NOTA IMPORTANTE:**
            // Cuando usas FormData, NO necesitas establecer el 'Content-Type': 'multipart/form-data'. 
            // El navegador lo hace automáticamente, incluyendo los límites de la data.

            fetch('/equipos/{{ $equipo->id }}/mantenimiento', {
                    method: 'POST',
                    headers: {
                        // Es crucial que incluyas tu token CSRF aquí si Laravel lo requiere
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                    },
                    body: datos // Envías el objeto FormData directamente
                })
                .then(response => {
                    if (response.ok) {
                        window.location.reload();
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Registro guardado:', data);
                    if (data.mensaje === 'Error de validacion') {
                        mostrarErrores(data.errors);
                    }

                })
                .catch(error => {
                    console.error('Error al enviar:', error);
                    //error 
                });
        });

        function mostrarErrores(errors) {
            const errorDiv = document.getElementById('error-message');
            const errorTitle = document.getElementById('error-title');
            const errorList = document.getElementById('error-list');

            errorTitle.textContent = 'Error de validación';
            errorList.innerHTML = '';

            // Recorrer todos los campos con errores
            for (const campo in errors) {
                if (errors.hasOwnProperty(campo)) {
                    errors[campo].forEach(error => {
                        const li = document.createElement('li');
                        li.textContent = `${campo}: ${error}`;
                        errorList.appendChild(li);
                    });
                }
            }

            errorDiv.style.display = 'block';
        }
    </script>
</x-app-layout>
