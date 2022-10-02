<?php require_once "vistas/parte_superior.php"?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- App css -->
    <link href="css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="css/app.min.css" rel="stylesheet" type="text/css" id="app-style">

</head>

<!-- prueba de codigo para kanban -->
<body class="show" data-layout-color="light" data-layout-mode="fluid" data-rightbar-onstart="true"
data-leftbar-theme="dark" data-leftbar-compact-mode="condensed">
    <div class="wrapper">
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="board">

                                <!-- COMIENZA PRIMER COLUMNA -->
                                <div class="tasks" data-plugin="dragula"
                                    data-containers="[&quot;task-list-one&quot;, &quot;task-list-two&quot;, &quot;task-list-three&quot;, &quot;task-list-four&quot;]">
                                    <h5 class="mt-0 task-header text-uppercase">Pendiente</h5>
                                    <div id="task-list-one" class="task-list-items">

                                        <!-- Tarea 1 -->
                                        <div class="card mb-0">
                                            <div class="card-body p-3">
                                                <small class="float-end text-muted">18 Jul 2022</small>
                                                <span class="badge bg-danger">Pendiente</span>

                                                <h5 class="mt-2 mb-2">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#task-detail-modal" class="text-body">Nueva conexion</a>
                                                </h5>

                                                <p class="mb-0">                                                            
                                                    <span class="text-nowrap mb-2 d-inline-block">                                                                
                                                        Descripcion de la tarea de ejemplo
                                                    </span>
                                                </p>
                                                <p class="mb-0">
                                                    <img src="img/icono_personas.png" alt="icono"
                                                        class="avatar-xs rounded-circle me-1">
                                                    <span class="align-middle">AB_Juan-Samuel</span>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Finaliza tarea 1 -->

                                        <!-- Tarea 2 -->
                                        <div class="card mb-0">
                                            <div class="card-body p-3">
                                                <small class="float-end text-muted">19 Jul 2022</small>
                                                <span class="badge bg-danger">Pendiente</span>

                                                <h5 class="mt-2 mb-2">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#task-detail-modal" class="text-body">Remplazo de modem</a>
                                                </h5>

                                                <p class="mb-0">                                                            
                                                    <span class="text-nowrap mb-2 d-inline-block">                                                                
                                                        Descripcion de la tarea de ejemplo
                                                    </span>
                                                </p>
                                                <p class="mb-0">
                                                    <img src="img/icono_personas.png" alt="icono"
                                                        class="avatar-xs rounded-circle me-1">
                                                    <span class="align-middle">AB_Nata</span>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Finaliza tarea 2 -->

                                        <!-- Tarea 3 -->
                                        <div class="card mb-0">
                                            <div class="card-body p-3">
                                                <small class="float-end text-muted">20 Jul 2022</small>
                                                <span class="badge bg-danger">Pendiente</span>

                                                <h5 class="mt-2 mb-2">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#task-detail-modal" class="text-body">Cable cortado</a>
                                                </h5>

                                                <p class="mb-0">                                                            
                                                    <span class="text-nowrap mb-2 d-inline-block">                                                                
                                                        Descripcion de la tarea de ejemplo
                                                    </span>
                                                </p>
                                                <p class="mb-0">
                                                    <img src="img/icono_personas.png" alt="icono"
                                                        class="avatar-xs rounded-circle me-1">
                                                    <span class="align-middle">AB_Juan-Samuel</span>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Finaliza tarea 3 -->

                                    </div>
                                </div>
                                <!-- FINALIZA PRIMER COLUMNA -->

                                <!-- COMIENZA SEGUNDA COLUMNA -->
                                <div class="tasks">
                                    <h5 class="mt-0 task-header text-uppercase">En progreso</h5>

                                    <div id="task-list-two" class="task-list-items">

                                        <!-- Tarea 1 -->
                                        <div class="card mb-0">
                                            <div class="card-body p-3">
                                                <small class="float-end text-muted">17 Jun 2022</small>
                                                <span class="badge bg-primary">En progreso</span>
                                                <h5 class="mt-2 mb-2">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#task-detail-modal" class="text-body">Servicio entrecortado</a>
                                                </h5>

                                                <p class="mb-0">                                                            
                                                    <span class="text-nowrap mb-2 d-inline-block">                                                                
                                                        Descripcion de la tarea de ejemplo
                                                    </span>
                                                </p>
                                                <p class="mb-0">
                                                    <img src="img/icono_personas.png" alt="icono"
                                                        class="avatar-xs rounded-circle me-1">
                                                    <span class="align-middle">AB_Juan-Samuel</span>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Finaliza tarea 1 -->

                                        <!-- Tarea 2 -->
                                        <div class="card mb-0">
                                            <div class="card-body p-3">
                                                <small class="float-end text-muted">17 Jun 2022</small>
                                                <span class="badge bg-primary">En progreso</span>
                                                <h5 class="mt-2 mb-2">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#task-detail-modal" class="text-body">Remplazo de modem</a>
                                                </h5>

                                                <p class="mb-0">                                                            
                                                    <span class="text-nowrap mb-2 d-inline-block">                                                                
                                                        Descripcion de la tarea de ejemplo
                                                    </span>
                                                </p>
                                                <p class="mb-0">
                                                    <img src="img/icono_personas.png" alt="icono"
                                                        class="avatar-xs rounded-circle me-1">
                                                    <span class="align-middle">AB_Nata</span>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Finaliza tarea 2 -->

                                        <!-- Tarea 3 -->
                                        <div class="card mb-0">
                                            <div class="card-body p-3">
                                                <small class="float-end text-muted">17 Jun 2022</small>
                                                <span class="badge bg-primary">En progreso</span>
                                                <h5 class="mt-2 mb-2">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#task-detail-modal" class="text-body">Nueva conexion</a>
                                                </h5>

                                                <p class="mb-0">                                                            
                                                    <span class="text-nowrap mb-2 d-inline-block">                                                                
                                                        Descripcion de la tarea de ejemplo
                                                    </span>
                                                </p>
                                                <p class="mb-0">
                                                    <img src="img/icono_personas.png" alt="icono"
                                                        class="avatar-xs rounded-circle me-1">
                                                    <span class="align-middle">AB_Juan-Samuel</span>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Finaliza tarea 3 -->

                                    </div>
                                </div>
                                <!-- FINALIZA SEGUNDA COLUMNA -->

                                <!-- COMIENZA TERCER COLUMNA -->
                                <div class="tasks">
                                    <h5 class="mt-0 task-header text-uppercase">Finalizado</h5>
                                    <div id="task-list-three" class="task-list-items">                                               
                                        
                                    <!-- Tarea 1 -->
                                    <div class="card mb-0">
                                            <div class="card-body p-3">
                                                <small class="float-end text-muted">23 Jun 2022</small>
                                                <span class="badge bg-success">Finalizado</span>
                                                <h5 class="mt-2 mb-2">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#task-detail-modal" class="text-body">Nueva conexion</a>
                                                </h5>

                                                <p class="mb-0">                                                            
                                                    <span class="text-nowrap mb-2 d-inline-block">                                                                
                                                        Descripcion de la tarea de ejemplo
                                                    </span>
                                                </p>
                                                <p class="mb-0">
                                                    <img src="img/icono_personas.png" alt="icono"
                                                        class="avatar-xs rounded-circle me-1">
                                                    <span class="align-middle">AB_Juan-Samuel</span>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Finaliza tarea 1 -->

                                        <!-- Tarea 2 -->
                                        <div class="card mb-0">
                                            <div class="card-body p-3">
                                                <small class="float-end text-muted">22 Jun 2022</small>
                                                <span class="badge bg-success">Finalizado</span>
                                                <h5 class="mt-2 mb-2">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#task-detail-modal" class="text-body">Servicio cortado</a>
                                                </h5>

                                                <p class="mb-0">                                                            
                                                    <span class="text-nowrap mb-2 d-inline-block">                                                                
                                                        Descripcion de la tarea de ejemplo
                                                    </span>
                                                </p>
                                                <p class="mb-0">
                                                    <img src="img/icono_personas.png" alt="icono"
                                                        class="avatar-xs rounded-circle me-1">
                                                    <span class="align-middle">AB_Juan-Samuel</span>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Finaliza tarea 2 -->

                                        <!-- Tarea 3 -->
                                        <div class="card mb-0">
                                            <div class="card-body p-3">
                                                <small class="float-end text-muted">24 Jun 2022</small>
                                                <span class="badge bg-success">Finalizado</span>
                                                <h5 class="mt-2 mb-2">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#task-detail-modal" class="text-body">Reemplazo de modem</a>
                                                </h5>

                                                <p class="mb-0">                                                            
                                                    <span class="text-nowrap mb-2 d-inline-block">                                                                
                                                        Descripcion de la tarea de ejemplo
                                                    </span>
                                                </p>
                                                <p class="mb-0">
                                                    <img src="img/icono_personas.png" alt="icono"
                                                        class="avatar-xs rounded-circle me-1">
                                                    <span class="align-middle">AB_Juan-Samuel</span>
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Finaliza tarea 3 -->
                                    </div>
                                </div>
                                <!-- FINALIZA TERCER COLUMA -->

                            </div> <!-- end .board-->
                        </div> <!-- end col --> 
                    </div><!-- end row-->
                </div> <!-- content -->        
            </div>
        </div>
    </div>
    <!-- bundle -->
    <script src="js/vendor.min.js"></script>
    <script src="js/app.min.js"></script>
     <!-- dragula js-->
     <script src="js/dragula.min.js"></script>
    <!-- demo js -->
    <script src="js/componen.dragula.js"></script>
</body>
<!-- finaliza prueba de codigo para kanban -->

<?php require_once "vistas/parte_inferior.php"?>