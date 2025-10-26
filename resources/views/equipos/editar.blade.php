<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Equipos - Editar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container">
                <!-- Header -->
                <div class="row page-header">
                    <div class="col-md-6">
                        <h1 class="fs-4 fw-bold">
                            <i class="bi bi-collection-fill"></i>
                            Formulario edicion de Equipos
                        </h1>
                    </div>
                </div>

                <!-- Formulario de filtros -->
                <div class="card filter-card p-4">
                    <form action="{{ route('equipos.update', $equipo) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripcion</label>
                            <textarea class="form-control" id="descripcion" rows="3" name="descripcion">{{ old('descripcion', $equipo->descripcion) }}</textarea>
                            @error('descripcion')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="marca" class="form-label">Marca</label>
                            <input type="text" class="form-control" name="marca" id="marca" placeholder="marca"
                                value="{{ old('marca', $equipo->marca) }}">
                            @error('marca')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="fecha_compra" class="form-label">Fecha compra</label>
                            <input type="date" class="form-control" name="fecha_compra" id="fecha_compra"
                                value="{{ old('fecha_compra', $equipo->fecha_compra) }}">
                            @error('fecha_compra')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select" aria-label="Default select example" id="estado" name="estado">
                                <option selected>Selecciona es estado</option>
                                <option value="0" @selected($equipo->estado == 0)>Operativo</option>
                                <option value="1" @selected($equipo->estado == 1)>Mantenimiento</option>
                                <option value="2" @selected($equipo->estado == 2)>Baja</option>
                            </select>
                            @error('estado')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex justify-end gap-4">
                            <a href="{{ route('equipos.index') }}">CANCELAR</a>
                            <button type="submit">ACTUALIZAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
