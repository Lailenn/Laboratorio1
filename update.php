<?php
include 'db.php';

// Verificar si el ID está presente en la URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: ID no proporcionado.");
}

$id = intval($_GET['id']); // Asegura que el ID sea un número entero
$result = $conn->query("SELECT * FROM agenda_de_contacto.usuarios WHERE id=$id");

// Verificar si el usuario existe
if ($result->num_rows == 0) {
    die("Error: No se encontró el usuario con ID $id.");
}

$row = $result->fetch_assoc();

// Si se envió el formulario, actualizar el contacto
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $edad = $_POST['edad'];

    $sql = "UPDATE agenda_de_contacto.usuarios SET 
            nombre='$nombre', 
            email='$email', 
            telefono='$telefono', 
            edad='$edad' 
            WHERE id=$id";

    if ($conn->query($sql)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error al actualizar: " . $conn->error;
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
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Editar Contacto</h2>
        <form method="POST" class="bg-light p-4 rounded shadow">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($row['nombre']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($row['email']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" value="<?= htmlspecialchars($row['telefono']) ?>">
            </div>
            <div class="mb-3">
                <label for="edad" class="form-label">Edad</label>
                <input type="number" name="edad" class="form-control" value="<?= htmlspecialchars($row['edad']) ?>">
            </div>
            <button type="submit" class="btn btn-warning">Actualizar Contacto</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
