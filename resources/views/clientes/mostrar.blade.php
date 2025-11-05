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
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cliente->membresias as $item)
                                    <tr>
                                        <th scope="row">{{ $item->id }}</th>
                                        <td>{{ date('d/m/Y', strtotime($item->fecha_inicio)) }} al
                                            {{ date('d/m/Y', strtotime($item->fecha_fin)) }}</td>
                                        <td>{{ $item->estado }}</td>
                                        <td>{{ $item->precio_pagado }} Bs.</td>
                                        <td>{{ $item->tipomembresia->nombre }}</td>
                                        <td>{{ $item->tipomembresia->precio }} Bs.</td>
                                        <td>
                                            <button type="button" class="btn-modal underline" data-item-id="{{ $item->id }}"
                                                data-bs-toggle="modal" data-bs-target="#formModal">
                                                Registrar Pago
                                            </button>
                                        </td>
                                    </tr>
                                    @if (count($item->pagos) > 0)
                                        <tr>
                                            <td colspan="7" style="align-content: center"><strong>historial de
                                                    pagos</strong></td>
                                        </tr>
                                        @foreach ($item->pagos as $pago)
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td colspan="2">{{ $pago->fecha }}</td>
                                                <td colspan="2">
                                                    {{ $pago->monto }} Bs.
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="border-b-2 border-black">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2"><strong>Saldo: </strong>
                                                {{ $item->tipomembresia->precio - $item->precio_pagado }} Bs.</td>
                                        </tr>
                                    @endif
                                    
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

    <!-- Modal -->
    <div class="modal fade" id="formModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Datos Adicionales</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="registroPagoForm">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="membresia_id" id="modalItemId">

                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" name="fecha" required>
                        </div>

                        <div class="mb-3">
                            <label for="monto" class="form-label">Monto</label>
                            <input type="text" class="form-control" name="monto"></input>
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
</x-app-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('formModal');
        const form = document.getElementById('registroPagoForm');
        const itemIdInput = document.getElementById('modalItemId');

        // Manejar clic en botones del modal
        document.querySelectorAll('.btn-modal').forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-item-id');
                itemIdInput.value = itemId;
            });
        });

        // Manejar envío del formulario
        form.addEventListener('submit', function(e) {
            e.preventDefault();


            const formulario = e.target;
            // 1. CAPTURAR DATOS
            const datos = new FormData(formulario);

            // **NOTA IMPORTANTE:**
            // Cuando usas FormData, NO necesitas establecer el 'Content-Type': 'multipart/form-data'. 
            // El navegador lo hace automáticamente, incluyendo los límites de la data.

            fetch('/pagos', {
                    method: 'POST',
                    headers: {
                        // Es crucial que incluyas tu token CSRF aquí si Laravel lo requiere
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]')
                            .content
                    },
                    body: datos // Envías el objeto FormData directamente
                })
                .then(response => {
                    if (response.ok) {
                        // **LA RECARGA DE PÁGINA OCURRE AQUÍ**
                        window.location.reload();
                        // Si quieres redirigir a otra URL: window.location.href = '/nueva-ruta';
                    }
                    return response.json();
                })
                .then(data => {
                    //if(response.ok)
                    console.log('Registro guardado:');
                })
                .catch(error => {
                    console.error('Error al enviar:', error);
                    // Manejo de error
                });
        });

    })
</script>
