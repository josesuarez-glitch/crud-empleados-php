<?php
require_once '../conexion.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $mysqli->real_escape_string($_POST['id']);
    $sql = "DELETE FROM empleados WHERE id = $id";
    if ($mysqli->query($sql)) {
        echo json_encode(['success' => true, 'mensaje' => 'Empleado eliminado']);
    } else {
        echo json_encode(['success' => false, 'mensaje' => 'Error al eliminar']);
    }
}
?>