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
                            Formulario edicion de Instructores
                        </h1>
                    </div>
                </div>

                <!-- Formulario de filtros -->
                <div class="card filter-card p-4">
                    <form action="{{ route('instructores.update', $instructor) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre"
                                placeholder="nombre" value="{{ old('nombre', $instructor->nombre) }}">
                            @error('nombre')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="apellido" id="apellido"
                                placeholder="apellidos" value="{{ old('apellido', $instructor->apellido) }}">
                            @error('apellido')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="especialidad" class="form-label">Especialidad</label>
                            <input type="text" class="form-control" name="especialidad" id="especialidad" value="{{ old('especialidad', $instructor->especialidad) }}">
                            @error('especialidad')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="celular" class="form-label">Celular</label>
                            <input type="text" class="form-control" name="celular" id="celular" value="{{ old('celular', $instructor->celular) }}">
                            @error('celular')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="carnet" class="form-label">Carnet</label>
                            <input type="text" class="form-control" name="carnet" id="carnet"
                                placeholder="carnet" value="{{ old('carnet', $instructor->carnet) }}">
                            @error('carnet')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" value="{{ old('direccion', $instructor->direccion) }}">
                            @error('direccion')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex justify-end gap-4">
                            <a href="{{ route('instructores.index') }}">CANCELAR</a>
                            <button type="submit">REGISTRAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
