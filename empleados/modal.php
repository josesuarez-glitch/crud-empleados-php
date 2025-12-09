<!-- Modal Crear / Editar -->
<div class="modal fade" id="modalCrear" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="formEmpleado" enctype="multipart/form-data">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" id="modalTitulo">Nuevo Empleado</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="id">
          <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Departamento</label>
            <?php include '../departamentos/combo.php'; ?>
          </div>
          <div class="mb-3">
            <label>Foto (opcional)</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
            <img id="preview" class="mt-2 img-thumbnail" width="150" style="display:none;">
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

<script>
// Preview de foto
document.querySelector('[name=foto]').addEventListener('change', function(e){
  if(e.target.files[0]){
    document.getElementById('preview').src = URL.createObjectURL(e.target.files[0]);
    document.getElementById('preview').style.display = 'block';
  }
});
</script>