<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos - Editar') }}
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
                            Formulario edición de Productos
                        </h1>
                    </div>
                </div>

                <!-- Formulario de filtros -->
                <div class="card filter-card p-4">
                    <form action="{{ route('productos.update', $producto) }}" method="post">
                        @csrf
                        @method("PUT")
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripcion</label>
                            <textarea class="form-control" id="descripcion" rows="3" name="descripcion">{{ old('descripcion', $producto->descripcion) }}</textarea>
                            @error('descripcion')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio (Bs)</label>
                            <input type="text" class="form-control" name="precio" id="precio"
                                value="{{ old('precio', $producto->precio) }}">
                            @error('precio')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                             <label for="stock" class="form-label">Stock</label>
                            <input type="text" class="form-control" name="stock" id="stock"
                                value="{{ old('stock', $producto->stock) }}">
                            @error('stock')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="marca" class="form-label">Marca</label>
                            <input type="text" class="form-control" name="marca" id="marca"
                                value="{{ old('marca', $producto->marca) }}">
                            @error('marca')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="fecha_vencimiento" class="form-label">Fecha vencimiento</label>
                            <input type="date" class="form-control" name="fecha_vencimiento" id="fecha_vencimiento"
                                value="{{ old('fecha_vencimiento', $producto->fecha_vencimiento) }}">
                            @error('fecha_vencimiento')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex justify-end gap-4">
                            <a href="{{ route('productos.index') }}">CANCELAR</a>
                            <button type="submit">ACTUALIZAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
