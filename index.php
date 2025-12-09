<?php require_once 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CRUD Empleados y Departamentos</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
      <li class="nav-item d-none d-sm-inline-block"><a href="#" class="nav-link">CRUD Profesional</a></li>
    </ul>
  </nav>

  <!-- Sidebar -->
    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">Mi Empresa</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <li class="nav-item">
            <a href="#" class="nav-link" onclick="cargarEmpleados()">
              <i class="nav-icon fas fa-users"></i>
              <p>Empleados</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link" onclick="cargarDepartamentos()">
              <i class="nav-icon fas fa-building"></i>
              <p>Departamentos</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid pt-4">
        <div id="contenido"></div>
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <strong>CRUD hecho con cariño 2025</strong>
  </footer>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function toast(tipo, titulo, mensaje) {
  const Toast = Swal.mixin({
    toast: true, position: 'top-end', showConfirmButton: false, timer: 3500, timerProgressBar: true
  });
  Toast.fire({ icon: tipo, title: titulo, html: '<small>'+mensaje+'</small>' });
}

function cargarEmpleados() {
  $("#contenido").load("empleados/listar.php", function() {
    if ($.fn.DataTable.isDataTable('#tablaEmpleados')) $('#tablaEmpleados').DataTable().destroy();
    $('#tablaEmpleados').DataTable({
      language: { url: "//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json" },
      pageLength: 10
    });
  });

  // ← AQUÍ ESTABA EL TRUCO
  $("#liEmpleados").addClass("menu-open");
  $("#liDepartamentos").removeClass("menu-open");
  $("#menuEmpleados").addClass("active");
  $("#menuDepartamentos").removeClass("active");
}

function cargarDepartamentos() {
  $("#contenido").load("departamentos/listar.php");

  $("#liDepartamentos").addClass("menu-open");
  $("#liEmpleados").removeClass("menu-open");
  $("#menuDepartamentos").addClass("active");
  $("#menuEmpleados").removeClass("active");
}

$(document).ready(function() {
  cargarEmpleados(); // carga inicial con menú correcto

  $("#menuEmpleados").on("click", function(e){ e.preventDefault(); cargarEmpleados(); });
  $("#menuDepartamentos").on("click", function(e){ e.preventDefault(); cargarDepartamentos(); });
});
</script>

<?php include 'empleados/scripts.php'; ?>
</body>
</html>