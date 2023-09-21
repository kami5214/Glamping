<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Reserva</title>
    <!-- Incluye aquí tus estilos CSS si los tienes -->
    <style>
        /* Estilos personalizados para tu documento HTML */
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Agrega más estilos personalizados si es necesario */
    </style>
</head>
<body>
    <h1>DETALLES DE RESERVA</h1>

    <table>
        <thead>
            <tr>
                <th style="width: 25%;">Campo</th>
                <th style="width: 75%;">Valor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Fecha de inicio</td>
                <td>{{ $reserva->res_fecha_ini }}</td>
            </tr>
            <tr>
                <td>Fecha final</td>
                <td>{{ $reserva->res_fecha_fin }}</td>
            </tr>
            <tr>
                <td>Nombre Usuario</td>
                <td>{{ $reserva->usuario->name }} {{ $reserva->usuario->usu_apellido }}</td>
            </tr>
            <tr>
                <td>Cedula Usuario</td>
                <td>{{ $reserva->usuario->usu_cedula }}</td>
            </tr>
            <tr>
                <td>Nombre Cliente</td>
                <td>{{ $reserva->cliente->cli_nombre }} {{ $reserva->cliente->cli_apellido }}</td>
            </tr>
            <tr>
                <td>Cedula Cliente</td>
                <td>{{ $reserva->cliente->cli_cedula }}</td>
            </tr>
            <tr>
                <td>Domo</td>
                <td>{{ $domo->dom_nombre }}</td>
            </tr>
            <tr>
                <td>Precio del Domo</td>
                <td>{{ $domo->dom_precio }}</td>
            </tr>
            <tr>
                <td>Servicios</td>
                <td>
                    @foreach($servicios as $servicio)
                        {{ $servicio->ser_nombre }}<br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Precios de Servicios</td>
                <td>
                    @foreach($servicios as $servicio)
                       {{ $servicio->ser_precio }}<br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Descuento</td>
                <td>{{ $reserva->res_descuento }}</td>
            </tr>
            <tr>
                <td>Total</td>
                <td>{{ $reserva->res_total }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Puedes agregar más contenido o elementos HTML si es necesario -->

    <!-- Incluye aquí tus scripts JS si los tienes -->

</body>
</html>

