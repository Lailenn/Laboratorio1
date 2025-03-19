<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $edad = $_POST['edad'];

    $sql = "INSERT INTO agenda_de_contacto.usuarios (nombre, email, telefono, edad) VALUES ('$nombre', '$email', '$telefono', '$edad')";
    if ($conn->query($sql)) {
        header('Location: index.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
$result = $conn->query("SELECT * FROM agenda_de_contacto.usuarios");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP con Bootstrap</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <div class="container mt-5">
        <div class="row">
        <div class="col-md-5 bg-primary text-white p-4 d-flex flex-column align-items-center justify-content-center rounded-start">
    <!-- Imagen dentro del cuadro azul -->
    <img src="https://static.vecteezy.com/system/resources/previews/017/396/815/non_2x/google-contacts-icon-free-png.png" alt="Imagen de Contacto" class="img-fluid mb-3" style="max-width: 230px; border-radius: 60%;">
    
</div>

            <div class="col-md-7 p-4 bg-white rounded-end shadow">
                <h2 class="text-center mb-4">Agregar Contacto</h2>
                <form method="POST">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre </label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico </label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control"required>
                    </div>
                    <div class="mb-3">
                        <label for="edad" class="form-label">Edad</label>
                        <input type="number" name="edad" class="form-control"required>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

        <table class="table table-striped mt-4">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Edad</th>
            <th>Acciones</th>
        </tr>
    </thead>

            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['nombre'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['telefono'] ?></td>
                    <td><?= $row['edad'] ?></td>
                    <td>
                        <a href="update.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
