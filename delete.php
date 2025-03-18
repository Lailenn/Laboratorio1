<?php
include 'db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM agenda_de_contacto.usuarios WHERE id=$id");
}

header('Location: index.php');
?>
