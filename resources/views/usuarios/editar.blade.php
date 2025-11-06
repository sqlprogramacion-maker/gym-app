<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios - Editar') }}
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
                            Formulario edicion de Usuarios
                        </h1>
                    </div>
                </div>

                <!-- Formulario de filtros -->
                <div class="card filter-card p-4">
                    <form action="{{ route('usuarios.update', $usuario)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="name"
                                value="{{ old('name', $usuario->name) }}">
                            @error('name')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo</label>
                            <input type="email" class="form-control" name="email" id="email"
                                placeholder="Correo" value="{{ old('email', $usuario->email) }}">
                            @error('email')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select class="form-select" aria-label="Default select example" name="rol">
                                <option selected>Selecciona un rol</option>
                                <option value="administrador" @selected($usuario->rol == 'administrador')>Administrador</option>
                                <option value="recepcionista" @selected($usuario->rol == 'recepcionista')>Recepcionista</option>
                            </select>
                            @error('rol')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex justify-end gap-4">
                            <a href="{{ route('usuarios.index') }}">CANCELAR</a>
                            <button type="submit">ACTUALIZAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>