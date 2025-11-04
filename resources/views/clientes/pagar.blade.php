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
                                        <td>{{ $item->precio_pagado }}</td>
                                        <td>{{ $item->tipomembresia->nombre }}</td>
                                        <td>{{ $item->tipomembresia->precio }}</td>
                                        <td><a href="">Pagar</a></td>
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
