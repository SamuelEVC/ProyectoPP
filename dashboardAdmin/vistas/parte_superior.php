<?php
session_start();

if($_SESSION["s_usuario"] === null){
    header("Location: ../index.php");
}elseif($_SESSION["s_idRol"] != 1){
    header("Location: ../dashboardEmpleado/index.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SiAdPe</title>
  
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  
  <!--datables personalizado-->  
  <link rel="stylesheet"  type="text/css" href="main.css">  

  <!--datables CSS básico-->
  <link rel="stylesheet" type="text/css" href="vendor/datatables/datatables.min.css"/>

  <!--datables estilo bootstrap 4 CSS-->  
  <link rel="stylesheet"  type="text/css" href="vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">    
    
  <!--Iconos de otros lados-->  
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!--datables CSS DATES-->
  <!-- <link rel="stylesheet"  type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/>  -->
  <link rel="stylesheet"  type="text/css"  href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css"/>

  <!--SweetAlert2-->
  <link rel="stylesheet" href="vendor/sweetalert2/sweetalert2.min.css"> 
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.min.css">  -->

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php" title="Sistema de Administración de Personal">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SiAdPe</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
        <i class="fa fa-home" aria-hidden="true"></i>
          <span>Pagina principal</span></a>
      </li>

     
      <!-- Nav Item - Informes -->
      <li class="nav-item" id="navItemxD">
        <a class="nav-link" href="empleados.php">
        <i class="fa fa-users" aria-hidden="true"></i>
        <span>Empleados</span></a>
      </li>
      <!-- Nav Item - Informes -->
      <li class="nav-item">
        <a class="nav-link" href="informes.php">
        <i class="fas fa-fw fa-table"></i>
        <span>Informes</span></a>
      </li>
      
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

         

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - AQUI ESTABAN LOS ALERTS -->

            <h4 class="text-center ml-2 mt-3">Área de: <span class="badge badge-info" style="font-size:22px;"><?php echo $_SESSION["s_area"]; ?></span></h4> 

            <h4 class="text-center ml-2 mt-3">Su permiso es: <span class="badge badge-warning" style="font-size:22px;"><?php echo $_SESSION["s_rol_descripcion"]; ?></span></h4> 

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="nombreUsuario" style="font-size:20px;"><?php echo $_SESSION["s_nombre"];?></span>
                <!--  <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">-->
                <img class="img-profile rounded-circle" src="img/Neco-Arc-Glasses.jpg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item btnEditarUsuario" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cambiar contraseña
                </a>
                  <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="../bd/logout.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Cerrar Sesión
                </a>


              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
        <div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form id="formEditarUsuario">    
                <div class="modal-body">
                    <div class="form-group">
                      <label  class="col-form-label">Contraseña actual:</label>
                      <input type="password" class="form-control" id="OldPassword">
                    </div>                           
                    <div class="form-group">
                      <label  class="col-form-label">Contraseña nueva:</label>
                      <input type="password" class="form-control" id="NewPassword">
                    </div>                   
                    <div class="form-group">
                      <label  class="col-form-label">Reescribe la contraseña nueva:</label>
                      <input type="password" class="form-control" id="NewPasswordrepeated">
                    </div>         
                    <div class="form-group form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck">
                      <label class="form-check-label" for="exampleCheck">Mostrar Contraseña</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-dark">Guardar</button>
                </div>
            </form>    
          </div>
        </div>
      </div>