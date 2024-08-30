<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Inicio - Erost</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('../assets/images/modelo.png'); /* Ruta de la imagen de la modelo */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background: rgba(0, 0, 0, 0.5); /* Fondo semitransparente para resaltar el contenido */
            padding: 20px;
            border-radius: 10px;
        }

        .logo {
            max-width: 300px; /* Ajusta el tamaño del logo según necesites */
            margin-bottom: 20px;
        }

        .btn-start {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: black; /* Color del botón */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-start:hover {
            background-color: #FF4081; /* Color al pasar el ratón sobre el botón */
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="../assets/images/LOGO EROST.jpg" alt="Logo de Erost" class="logo">
        <button onclick="window.location.href='login.php';" class="btn-start">Comenzar</button>
    </div>
</body>
</html>
