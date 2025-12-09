<?php require_once '../conexion.php'; ?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title"><i class="fas fa-building"></i> Lista de Departamentos</h3>
    <div class="card-tools">
      <button type="button" class="btn btn-tool btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalDepartamento">
        <i class="fas fa-plus"></i> Nuevo Departamento
      </button>
    </div>
  </div>
  <div class="card-body">
    <table class="table table-bordered table-hover">
      <thead class="table-dark">
        <tr>
          <th>Nombre</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM departamentos ORDER BY nombre";
        $res = $mysqli->query($sql);
        while ($row = $res->fetch_assoc()) { ?>
          <tr>
            <td><?= htmlspecialchars($row['nombre']) ?></td>
            <td>
              <button class="btn btn-warning btn-sm" onclick="editarDepartamento(<?= $row['id'] ?>)">
                <i class="fas fa-edit"></i>
              </button>
              <button class="btn btn-danger btn-sm" onclick="eliminarDepartamento(<?= $row['id'] ?>)">
                <i class="fas fa-trash"></i>
              </button>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal para Departamentos -->
<div class="modal fade" id="modalDepartamento" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formDepartamento">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" id="modalTituloDepto">Nuevo Departamento</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="idDepto">
          <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>