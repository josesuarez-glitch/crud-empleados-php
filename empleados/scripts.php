<script>
// Inicializar DataTable
$(document).ready(function() {
  $('#tablaEmpleados').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"
    },
    "pageLength": 5
  });
});

// Crear/Editar Empleado
$('#formEmpleado').on('submit', function(e) {
  e.preventDefault();
  let formData = new FormData(this);
  let url = $('#id').val() ? 'empleados/editar.php' : 'empleados/crear.php';
  $.ajax({
    url: url,
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function(response) {
      let res = JSON.parse(response);
      toast(res.success ? 'success' : 'error', res.success ? 'Éxito' : 'Error', res.mensaje);
      if (res.success) {
        $('#modalCrear').modal('hide');
        cargarEmpleados();
      }
    }
  });
});

// Editar Empleado
function editar(id) {
  $.ajax({
    url: 'empleados/listar.php',
    type: 'POST',
    data: { id: id, accion: 'editar' },
    success: function(response) {
      let empleado = JSON.parse(response);
      $('#id').val(empleado.id);
      $('[name=nombre]').val(empleado.nombre);
      $('[name=apellido]').val(empleado.apellido);
      $('[name=email]').val(empleado.email);
      $('[name=departamento_id]').val(empleado.departamento_id);
      $('#modalTitulo').text('Editar Empleado');
      $('#modalCrear').modal('show');
    }
  });
}

// Eliminar Empleado
function eliminar(id) {
  Swal.fire({
    title: '¿Estás seguro?',
    text: "¡No podrás revertir esto!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: 'empleados/eliminar.php',
        type: 'POST',
        data: { id: id },
        success: function(response) {
          let res = JSON.parse(response);
          toast(res.success ? 'success' : 'error', res.success ? 'Éxito' : 'Error', res.mensaje);
          if (res.success) cargarEmpleados();
        }
      });
    }
  });
}

// Cargar empleados al inicio
function cargarEmpleados() {
  $("#contenido").load("empleados/listar.php");
}
cargarEmpleados();
</script>