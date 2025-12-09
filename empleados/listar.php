<?php require_once '../conexion.php'; ?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title"><i class="fas fa-users"></i> Lista de Empleados</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalCrear">
        <i class="fas fa-plus"></i> Nuevo Empleado
      </button>
    </div>
  </div>
  <div class="card-body">
    <table id="tablaEmpleados" class="table table-bordered table-hover">
      <thead class="table-dark">
        <tr>
          <th>Foto</th>
          <th>Nombre Completo</th>
          <th>Email</th>
          <th>Departamento</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT e.*, d.nombre as depto 
                FROM empleados e 
                LEFT JOIN departamentos d ON e.departamento_id = d.id 
                ORDER BY e.apellido";
        $res = $mysqli->query($sql);
        while ($row = $res->fetch_assoc()) { ?>
          <tr>
          <td class="text-center">
  <?php if ($row['foto'] && $row['foto'] != 'default.jpg'): ?>
    <img src="assets/img/empleados/<?= htmlspecialchars($row['foto']) ?>" 
         class="img-circle elevation-2" width="50" height="50" alt="Foto">
  <?php else: ?>
    <i class="fas fa-user-circle text-muted" style="font-size: 50px;"></i>
  <?php endif; ?>
</td>
            <td><?= htmlspecialchars($row['nombre'].' '.$row['apellido']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['depto'] ?? 'Sin departamento') ?></td>
            <td>
              <button class="btn btn-warning btn-sm" onclick="editar(<?= $row['id'] ?>)">
                <i class="fas fa-edit"></i>
              </button>
              <button class="btn btn-danger btn-sm" onclick="eliminar(<?= $row['id'] ?>)">
                <i class="fas fa-trash"></i>
              </button>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Incluimos los modales y scripts específicos -->
<?php include 'modal.php'; ?>