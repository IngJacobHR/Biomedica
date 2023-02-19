<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Llamado de emergencia</title>
</head>
<body>
    <p>Hola! Se ha reportado una alteración en la temperatura a las {{$updated_at}}.</p>
    <p>Estos son los datos registrados durante la emergia:</p>
    <ul>
        <li>Sensor: {{ $name }} </li>
        <li>Medición: {{ $val }} </li>
        <li>Ubicación: {{ $location}} </li>

    </ul>
</body>
</html>
