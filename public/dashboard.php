<?php include '../includes/db.php'; ?>
<?php session_start(); ?>

<?php
// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$nombre = $_SESSION['user_name'];
$rol = $_SESSION['user_role'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: white;
        }
        .navbar {
            background-color: black;
        }
        .navbar-brand {
            color: white;
            font-weight: bold;
        }
        .navbar-brand:hover {
            color: white;
        }
        .dashboard-content {
            padding: 5px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-top: 5px;
        }
        .footer {
            text-align: center;
            padding: 2px;
            background-color: black;
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
        <img src="../assets/images/LOGO EROST.jpg" alt="Logo" width="100" height="50" class="d-inline-block align-top"> 
            </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="profile.php">Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="dashboard-content">
        <h2 class="text-center">Bienvenido, <?php echo $nombre; ?></h2>
        <p class="text-center">Rol: <?php echo $rol; ?></p>

        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Usuarios</h5>
                        <p class="card-text">Gestiona los usuarios de la plataforma.</p>
                        <a href="../user_management.php" class="btn btn-primary">Ver Usuarios</a>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Competencias</h5>
                        <p class="card-text">Gestiona las competencias laborales.</p>
                        <a href="competences.php" class="btn btn-primary">Ver Competencias</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Modelos</h5>
                        <p class="card-text">Visualiza y gestiona los modelos.</p>
                        <a href="models.php" class="btn btn-primary">Ver Modelos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <p>Mi Aplicación © 2024. Todos los derechos reservados.</p>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

