<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Clientes</title>

    <!-- Estilos simples opcionales -->
    <style>
        body {
            font-family: Arial, sans-serif;
            padding-top: -10px !important;
            padding: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #f3f3f3;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }
    </style>

</head>

<body>

    <h2>Reporte de Clientes</h2>
    <p><strong>Reporte generado por: </strong>{{ $user->name }}<strong> en fecha: </strong> {{ date('d-m-Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Edad</th>
                <th>Peso (kg)</th>
                <th>Carnet</th>
                <th>Teléfono</th>
                <th>Talla (cm)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->apellido }}</td>
                    <td>{{ $cliente->edad }}</td>
                    <td>{{ $cliente->peso }}</td>
                    <td>{{ $cliente->carnet }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->talla }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">No hay clientes registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
