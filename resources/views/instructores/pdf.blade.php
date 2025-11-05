<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Entrenadores</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 10px;
            padding-top: -10px !important;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
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

    <h2>Reporte de Entrenadores</h2>
    <p><strong>Reporte generado por: </strong>{{ $user->name }}<strong> en fecha: </strong> {{ date('d-m-Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Especialidad</th>
                <th>Celular</th>
                <th>Carnet</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($entrenadores as $entrenador)
                <tr>
                    <td>{{ $entrenador->nombre }}</td>
                    <td>{{ $entrenador->apellido }}</td>
                    <td>{{ $entrenador->especialidad }}</td>
                    <td>{{ $entrenador->celular }}</td>
                    <td>{{ $entrenador->carnet }}</td>
                    <td>{{ $entrenador->direccion }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">No hay entrenadores registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
