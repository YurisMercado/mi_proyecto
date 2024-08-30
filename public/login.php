<?php include '../includes/db.php'; ?>
<?php session_start(); ?>

<?php
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, nombre, contraseña, rol FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nombre, $hashedPassword, $rol);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $nombre;
            $_SESSION['user_role'] = $rol;

            header("Location: dashboard.php");
            exit();
        } else {
            $error_message = "Credenciales incorrectas.";
        }
    } else {
        $error_message = "Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Roboto', sans-serif;
        }
        .form-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
            margin: auto;
        }
        .form-container img {
            max-width: 120px;
            height: auto;
            margin-bottom: 20px;
        }
        .form-container h2 {
            margin-bottom: 20px;
            color: #333;
            font-weight: bold;
        }
        .form-container .form-control {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
        }
        .form-container .btn-primary {
            width: 50%;
            padding: 10px;
            font-size: 16px;
            background-color: #d4af37; 
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .form-container .btn-primary:hover {
            background-color: #b08a2e; 
        }
        .form-container a {
            display: block;
            margin-top: 10px;
            color: #d4af37; 
            text-decoration: none;
            font-size: 14px;
        }
        .form-container a:hover {
            text-decoration: underline;
            color: #b08a2e; 
        }
        .alert {
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <img src="../assets/images/LOGO EROST.jpg" alt="Logo" class="logo-img"> 
        <h2>Bienvenido</h2>
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary">Ingresar</button>
        </form>
        <a href="register.php">¿No tienes cuenta? Regístrate</a>
        <a href="#" class="btn btn-link mt-3">Volver</a>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
