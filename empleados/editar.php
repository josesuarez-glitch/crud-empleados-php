<?php
require_once '../conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $mysqli->real_escape_string($_POST['id']);
    $nombre = $mysqli->real_escape_string($_POST['nombre']);
    $apellido = $mysqli->real_escape_string($_POST['apellido']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $departamento_id = $_POST['departamento_id'] ?: NULL;

    $sql = "UPDATE empleados SET nombre = '$nombre', apellido = '$apellido', 
            email = '$email', departamento_id = '$departamento_id' WHERE id = $id";
    if ($mysqli->query($sql)) {
        // Subir nueva foto si existe
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $foto = "emp_" . $id . "." . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['foto']['tmp_name'], "../assets/img/empleados/$foto");
            $mysqli->query("UPDATE empleados SET foto = '$foto' WHERE id = $id");
        }
        echo json_encode(['success' => true, 'mensaje' => 'Empleado actualizado']);
    } else {
        echo json_encode(['success' => false, 'mensaje' => 'Error al actualizar']);
    }
}
?>