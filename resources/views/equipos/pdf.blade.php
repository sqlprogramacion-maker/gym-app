<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Equipos</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
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

    <h2>Reporte de Equipos</h2>
    <p><strong>Reporte generado por: </strong>{{ $user->name }}<strong> en fecha: </strong> {{ date('d-m-Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Marca</th>
                <th>Fecha de Compra</th>
                <th>Estado</th>
                <th>Último Mantenimiento</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($equipos as $equipo)
                <tr>
                    <td>{{ $equipo->descripcion }}</td>
                    <td>{{ $equipo->marca }}</td>
                    <td>{{ $equipo->fecha_compra }}</td>
                    <td>{{ $equipo->estado }}</td>
                    <td>{{ $equipo->ultimo_mantenimiento }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">No hay equipos registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
