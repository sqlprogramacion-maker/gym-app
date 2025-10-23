<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes - Nuevo') }}
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
                            Formulario registro de Clientes
                        </h1>
                    </div>
                </div>

                <!-- Formulario de filtros -->
                <div class="card filter-card p-4">
                    <form action="{{ route('clientes.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre"
                                placeholder="nombre" value="{{ old('nombre') }}">
                            @error('nombre')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="apellido" id="apellido"
                                placeholder="apellidos" value="{{ old('apellido') }}">
                            @error('apellido')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="edad" class="form-label">Edad</label>
                            <input type="number" class="form-control" name="edad" id="edad" value="{{ old('edad') }}">
                            @error('edad')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="peso" class="form-label">Peso</label>
                            <input type="number" class="form-control" name="peso" id="peso" value="{{ old('peso') }}">
                            @error('peso')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="carnet" class="form-label">Carnet</label>
                            <input type="text" class="form-control" name="carnet" id="carnet"
                                placeholder="carnet" value="{{ old('carnet') }}">
                            @error('carnet')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Telefono</label>
                            <input type="number" class="form-control" name="telefono" id="telefono" value="{{ old('telefono') }}">
                            @error('telefono')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="talla" class="form-label">Talla</label>
                            <input type="number" class="form-control" name="talla" id="talla" value="{{ old('talla') }}">
                            @error('talla')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex justify-end gap-4">
                            <a href="{{ route('clientes.index') }}">CANCELAR</a>
                            <button type="submit">REGISTRAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
