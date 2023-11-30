<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh; /* Establecer el 100% de la altura de la ventana gráfica */
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            color: #666;
        }
    </style>
</head>
<body>

    <h1>¡Bienvenido, {{ $user->name }}!</h1>

    <p>Ahora se pueden trabajar con las tareas</p>

</body>
</html>
