<?php include '../includes/db.php'; ?>
<?php session_start(); ?>

<?php
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$user_id = $_GET['id'];

// Eliminar usuario
$stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $user_id);

if ($stmt->execute()) {
    echo "Usuario eliminado correctamente.";
    header("Location: dashboard.php");
    exit();
} else {
    echo "Error al eliminar el usuario.";
}
?>
