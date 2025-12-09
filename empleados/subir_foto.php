<?php
require_once '../conexion.php';
if (isset($_POST['id']) && isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $id = $mysqli->real_escape_string($_POST['id']);
    $foto = "emp_" . $id . "." . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    if (move_uploaded_file($_FILES['foto']['tmp_name'], "../assets/img/empleados/$foto")) {
        $mysqli->query("UPDATE empleados SET foto = '$foto' WHERE id = $id");
        echo json_encode(['success' => true, 'mensaje' => 'Foto subida']);
    } else {
        echo json_encode(['success' => false, 'mensaje' => 'Error al subir foto']);
    }
}
?>