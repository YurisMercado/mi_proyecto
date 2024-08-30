<?php include '../includes/db.php'; ?>
<?php session_start(); ?>

<?php
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$user_id = $_GET['id'];
$error_message = '';

// Obtener los datos del usuario
$stmt = $conn->prepare("SELECT nombre, email, rol FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nombre, $email, $rol);
$stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];

    // Actualizar usuario
    $stmt = $conn->prepare("UPDATE usuarios SET nombre = ?, email = ?, rol = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nombre, $email, $rol, $user_id);

    if ($stmt->execute()) {
        header("Location: user_management.php");
        exit();
    } else {
        $error_message = "Error al actualizar el usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Editar Usuario</h2>
    <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form action="edit_user.php?id=<?php echo $user_id; ?>" method="POST" class="w-50 mx-auto">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
        </div>
        <div class="mb-3">
            <label for="rol" class="form-label">Rol</label>
            <select class="form-select" id="rol" name="rol" required>
                <option value="usuario" <?php echo ($rol == 'usuario') ? 'selected' : ''; ?>>Usuario</option>
                <option value="admin" <?php echo ($rol == 'admin') ? 'selected' : ''; ?>>Administrador</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary btn-sm">Guardar Cambios</button>
    </form>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

   
