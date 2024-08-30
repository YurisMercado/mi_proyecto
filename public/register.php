<?php include '../includes/db.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $rol = 'usuario'; // Default role

    // Verificar email único
    $checkEmail = $conn->prepare("SELECT email FROM usuarios WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $result = $checkEmail->get_result();

    if ($result->num_rows > 0) {
        echo "El correo ya está registrado.";
    } else {
        // Insertar usuario
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, contraseña, rol) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $email, $password, $rol);

        if ($stmt->execute()) {
            echo "Usuario registrado correctamente.";
            header("Location: login.php");
            exit();
        } else {
            echo "Error al registrar el usuario.";
        }
    }
}
?>

<?php include '../includes/db.php'; ?>

<?php
$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $rol = 'usuario'; // Rol predeterminado para nuevos usuarios

    // Verificar si el correo electrónico ya está registrado
    $checkEmail = $conn->prepare("SELECT email FROM usuarios WHERE email = ?");
    $checkEmail->bind_param("s", $email);
    $checkEmail->execute();
    $checkEmail->store_result();

    if ($checkEmail->num_rows > 0) {
        $error_message = "El correo ya está registrado.";
    } else {
        // Insertar nuevo usuario
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, contraseña, rol) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $email, $password, $rol);

        if ($stmt->execute()) {
            $success_message = "Usuario registrado correctamente. ¡Puedes iniciar sesión ahora!";
        } else {
            $error_message = "Error al registrar el usuario. Inténtalo de nuevo.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
            margin: auto;
        
        }
        .register-container h2 {
            margin-bottom: 20px;
            color: #333;
            font-weight: bold;
        }
        .register-container .form-control {
            margin-bottom: 11px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
        
        }
        .register-container .btn-primary {
            width: 100px; 
            background-color: #F4D03F;
        }
        .register-container a {
            display: block;
            margin-top: 10px;
            color: black;
            text-decoration: none;
        }
        .register-container a:hover {
            text-decoration: underline;
        }
        .form-label {
            color: black;
        }
        .alert {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Registro</h2>
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php elseif (!empty($success_message)): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <form action="register.php" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Completo" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Registrar</button>
        </form>
        <a href="login.php">¿Ya tienes cuenta? Inicia sesión</a>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

