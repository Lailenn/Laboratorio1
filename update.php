<?php
include 'db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM agenda_de_contacto.usuarios WHERE id=$id");
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $edad = $_POST['edad'];

    if (empty($nombre) || empty($email) || empty($telefono) || empty($edad)) {
        echo "<script>alert('Todos los campos son obligatorios.'); window.history.back();</script>";
        exit();
    }

    $sql = "UPDATE agenda_de_contacto.usuarios SET nombre='$nombre', email='$email', telefono='$telefono', edad='$edad' WHERE id=$id";
    if ($conn->query($sql)) {
        header('Location: index.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contacto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Agenda de Contactos</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Editar Contacto</h2>
        <form method="POST" class="bg-light p-4 rounded shadow">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre *</label>
                <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($row['nombre']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico *</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($row['email']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono *</label>
                <input type="text" name="telefono" class="form-control" value="<?= htmlspecialchars($row['telefono']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="edad" class="form-label">Edad *</label>
                <input type="number" name="edad" class="form-control" value="<?= htmlspecialchars($row['edad']) ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Actualizar Contacto</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

   
    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; 2025 Agenda de Contactos - Todos los derechos reservados</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
