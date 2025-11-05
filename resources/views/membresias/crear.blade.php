<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Membresias - Nuevo') }}
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
                            Formulario de asignacion de Membresias
                        </h1>
                    </div>
                </div>

                <!-- Formulario de filtros -->
                <div class="card filter-card p-4">
                    <form action="{{ route('membresias.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="cliente_id" class="form-label">Cliente</label>
                            <select class="form-select" aria-label="Default select example" name="cliente_id">
                                <option selected>Seleccionar cliente</option>
                                @foreach ($clientes as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }} - {{ $item->apellido }} - {{ $item->carnet }}</option>
                                @endforeach
                            </select>
                            @error('cliente_id')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tipomembresia_id" class="form-label">Membresia</label>
                            <select class="form-select" aria-label="Default select example" name="tipomembresia_id">
                                <option selected>Seleccionar membresia</option>
                                @foreach ($tipomembresias as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }} - {{ $item->meses }} (meses) - {{ $item->precio }} Bs.</option>
                                @endforeach
                            </select>
                            @error('cliente_id')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                         <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha inicio</label>
                            <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio') }}">
                            @error('fecha_inicio')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="precio_pagado" class="form-label">Precio Pagado</label>
                            <input type="text" class="form-control" name="precio_pagado" id="precio_pagado" value="{{ old('fecha_inicio') }}">
                            @error('precio_pagado')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="d-flex justify-end gap-4">
                            <a href="{{ route('membresias.index') }}">CANCELAR</a>
                            <button type="submit">REGISTRAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
