<?php
require_once '../conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $mysqli->real_escape_string($_POST['nombre']);
    $apellido = $mysqli->real_escape_string($_POST['apellido']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $departamento_id = $_POST['departamento_id'] ?: NULL;

    // Insertar empleado sin foto primero
    $sql = "INSERT INTO empleados (nombre, apellido, email, departamento_id) 
            VALUES ('$nombre', '$apellido', '$email', '$departamento_id')";
    if ($mysqli->query($sql)) {
        $id = $mysqli->insert_id;
        // Subir foto si existe
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $foto = "emp_" . $id . "." . pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['foto']['tmp_name'], "../assets/img/empleados/$foto");
            $mysqli->query("UPDATE empleados SET foto = '$foto' WHERE id = $id");
        }
        echo json_encode(['success' => true, 'mensaje' => 'Empleado creado con éxito']);
    } else {
        echo json_encode(['success' => false, 'mensaje' => 'Error al crear empleado']);
    }
}
?>