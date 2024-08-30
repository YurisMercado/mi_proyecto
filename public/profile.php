<?php include '../includes/db.php'; ?>
<?php session_start(); ?>

<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$error_message = '';
$success_message = '';

// Obtener los datos del usuario desde la base de datos
$stmt = $conn->prepare("SELECT nombre, email FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nombre, $email);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    // Actualizar el perfil del usuario
    $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $nombre, $email, $user_id);

    if ($stmt->execute()) {
        $success_message = "Perfil actualizado correctamente.";
        $_SESSION['user_name'] = $nombre; // Actualizar el nombre en la sesión
    } else {
        $error_message = "Error al actualizar el perfil.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
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
        .profile-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
            margin: auto;
        }
        .profile-container img {
            max-width: 120px;
            height: auto;
            margin-bottom: 20px;
        }
        .profile-container h2 {
            margin-bottom: 20px;
            color: #333;
            font-weight: bold;
        }
        .profile-container .form-control{
            margin-bottom: 11px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
        }
        .form-container .btn-primary {
            width: 100px; 
            background-color: #F4D03F;
        }
            
        .alert {
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <img src="../assets/images/lOGO EROST.jpg" alt="Logo"> 
        <h2>Editar Perfil</h2>
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php elseif (!empty($success_message)): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <form action="profile.php" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Guardar Cambios</button>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
