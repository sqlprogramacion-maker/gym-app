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
                            <i class="bi bi-collection-fill"></i>
                            Formulario registro de Membresias
                        </h1>
                    </div>
                </div>

                <!-- Formulario de filtros -->
                <div class="card filter-card p-4">
                    <form action="{{ route('tipomembresia.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre"
                                value="{{ old('nombre') }}">
                            @error('nombre')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                           <label for="meses" class="form-label">Duracion (meses)</label>
                            <input type="number" class="form-control" name="meses" id="meses"
                                value="{{ old('meses') }}">
                            @error('meses')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">precio</label>
                            <input type="text" class="form-control" name="precio" id="precio"
                                value="{{ old('precio') }}">
                            @error('precio')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                           <label for="beneficios" class="form-label">Beneficios</label>
                            <textarea class="form-control" id="benficios" rows="3" name="beneficios">{{ old('beneficios') }}</textarea>
                            @error('benficios')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex justify-end gap-4">
                            <a href="{{ route('tipomembresia.index') }}">CANCELAR</a>
                            <button type="submit">REGISTRAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
