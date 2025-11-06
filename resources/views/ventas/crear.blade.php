<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ventas - Nuevo') }}
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
                            Formulario registro de Ventas
                        </h1>
                    </div>
                </div>

                <!-- Formulario de filtros -->
                <div class="card filter-card p-4">
                    <form action="{{ route('ventas.store') }}" method="POST" id="formVenta">
                        @csrf

                        <div class="mb-3">
                            <label for="cliente_id" class="form-label">Cliente</label>
                            <select class="form-select" aria-label="Default select example" name="cliente_id">
                                <option selected>Seleccionar cliente</option>
                                @foreach ($clientes as $item)
                                    <option value="{{ $item->id }}">{{ $item->nombre }} - {{ $item->apellido }} -
                                        {{ $item->carnet }}</option>
                                @endforeach
                            </select>
                            @error('cliente_id')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="razon_social" class="form-label">Razon Social</label>
                            <input type="text" class="form-control" name="razon_social" id="razon_social"
                                placeholder="razon_social" value="{{ old('razon_social') }}">
                            @error('razon_social')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nit" class="form-label">Nit</label>
                            <input type="text" class="form-control" name="nit" id="nit" placeholder="nit">
                            @error('nit')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Selección de Producto -->
                        <div class="row mt-3">
                            <label for="nit" class="form-label">Detalle de productos</label>
                            <div class="col-md-5">
                                <select id="productoSelect" class="form-select" name="productos">
                                    <option value="">Seleccione un producto</option>
                                    @foreach ($productos as $p)
                                        <option value="{{ $p->id }}" data-precio="{{ $p->precio }}">
                                            {{ $p->descripcion }} | Stock: {{ $p->stock }} | Bs
                                            {{ $p->precio }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="number" id="cantidad" class="form-control" placeholder="Cantidad">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success" id="agregarProducto">Agregar</button>
                            </div>
                        </div>

                        <!-- Tabla de Detalles -->
                        <table class="table mt-4" id="tablaDetalles">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio (Bs)</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>

                        <!-- Total -->
                        <div class="text-end">
                            <h4>Total: Bs <span id="total">0.00</span></h4>
                            <input type="hidden" name="total" id="totalInput" value="0">
                        </div>

                        <button class="btn btn-primary mt-3" type="submit">Registrar Venta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let total = 0;
        let index = 0;

        document.getElementById('agregarProducto').addEventListener('click', () => {
            const select = document.getElementById('productoSelect');
            const cantidadInput = document.getElementById('cantidad');

            const prodId = select.value;
            const precio = parseFloat(select.options[select.selectedIndex].dataset.precio);
            const prodNombre = select.options[select.selectedIndex].text;
            const cantidad = parseInt(cantidadInput.value);

            if (!prodId || cantidad <= 0) {
                alert("Seleccione un producto y cantidad válida");
                return;
            }

            const subtotal = (precio * cantidad);

            let fila = `
        <tr>
            <td>${prodNombre}
                <input type="hidden" name="productos[${index}][id]" value="${prodId}">
            </td>
            <td>${precio}
                <input type="hidden" name="productos[${index}][precio]" value="${precio}">
            </td>
            <td>${cantidad}
                <input type="hidden" name="productos[${index}][cantidad]" value="${cantidad}">
            </td>
            <td>${subtotal.toFixed(2)}
                <input type="hidden" name="productos[${index}][subtotal]" value="${subtotal}">
            </td>
            <td><button type="button" class="btn btn-danger btn-sm eliminar">X</button></td>
        </tr>
    `;

            index++;
            total += subtotal;

            document.querySelector('#tablaDetalles tbody').insertAdjacentHTML('beforeend', fila);
            document.getElementById('total').innerHTML = total.toFixed(2);
            document.getElementById('totalInput').value = total.toFixed(2);
            cantidadInput.value = "";
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('eliminar')) {
                const fila = e.target.closest('tr');
                const subtotal = parseFloat(fila.querySelector('input[name="productos[][subtotal]"]').value);
                total -= subtotal;

                fila.remove();

                document.getElementById('total').innerText = total;
                document.getElementById('totalInput').value = total;
            }
        });
    </script>
</x-app-layout>
