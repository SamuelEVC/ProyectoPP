<?php require_once "vistas/parte_superior.php"?>

<?php

include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

//consulta oendientes


$CuadrillaID = $_SESSION["s_idCuadrilla"];


// $Consulta = "SELECT        Cuadrillas.id
// FROM     Cuadrillas INNER JOIN
//  Empleados ON Cuadrillas.id = Empleados.id_cuadrilla INNER JOIN
//  Usuarios ON Empleados.id_usuario = Usuarios.id
// where usuarios.id = '$idUsuario'
// group by         Cuadrillas.id, Cuadrillas.nombre";

// $resultado= $conexion->prepare($Consulta);
// $resultado->execute();
// $Cuadrillas=$resultado->fetchAll(PDO::FETCH_ASSOC);

// $CuadrillaID = $Cuadrillas[0]['id'];  


$Consulta="SELECT tipologias.descripcion AS Tipos, cuadrillas.nombre AS Cuadrilla, tareas.descripcion AS TareaDesc, tareas.fecha_inicio AS FechaInicio, estados.estado AS Estado, tareas.id as tarea_ID, tareas.fecha_finalizacion, tareas.resolucion as Resolucion FROM cuadrillas INNER JOIN tareas_empleados ON cuadrillas.id = tareas_empleados.id_cuadrilla INNER JOIN tareas ON tareas_empleados.id_tarea = tareas.id INNER JOIN tipologias ON tareas.id_tipologia = tipologias.id INNER JOIN estados ON tareas.id_estado = estados.id WHERE estado = 'Pendiente' and cuadrillas.id = '$CuadrillaID' GROUP BY tarea_ID";

$resultado= $conexion->prepare($Consulta);
$resultado->execute();
$dataPen=$resultado->fetchAll(PDO::FETCH_ASSOC);


$Consulta="SELECT tipologias.descripcion AS Tipos, cuadrillas.nombre AS Cuadrilla, tareas.descripcion AS TareaDesc, tareas.fecha_inicio AS FechaInicio, estados.estado AS Estado, tareas.id as tarea_ID, tareas.fecha_finalizacion, tareas.resolucion as Resolucion FROM cuadrillas INNER JOIN tareas_empleados ON cuadrillas.id = tareas_empleados.id_cuadrilla INNER JOIN tareas ON tareas_empleados.id_tarea = tareas.id INNER JOIN tipologias ON tareas.id_tipologia = tipologias.id INNER JOIN estados ON tareas.id_estado = estados.id WHERE estado = 'Proceso' and cuadrillas.id = '$CuadrillaID' GROUP BY tarea_ID";


$resultado= $conexion->prepare($Consulta);
$resultado->execute();
$dataPros=$resultado->fetchAll(PDO::FETCH_ASSOC);


$Consulta="SELECT tipologias.descripcion AS Tipos, cuadrillas.nombre AS Cuadrilla, tareas.descripcion AS TareaDesc, tareas.fecha_inicio AS FechaInicio, estados.estado AS Estado, tareas.id as tarea_ID, tareas.fecha_finalizacion, tareas.resolucion as Resolucion FROM cuadrillas INNER JOIN tareas_empleados ON cuadrillas.id = tareas_empleados.id_cuadrilla INNER JOIN tareas ON tareas_empleados.id_tarea = tareas.id INNER JOIN tipologias ON tareas.id_tipologia = tipologias.id INNER JOIN estados ON tareas.id_estado = estados.id WHERE estado = 'Finalizada' and cuadrillas.id = '$CuadrillaID' GROUP BY tarea_ID";
//$Consulta="SELECT Tipologias.descripcion AS Tipos, Cuadrillas.nombre AS Cuadrilla, Tareas.descripcion AS TareaDesc, Tareas.fecha_inicio AS FechaInicio, Estados.estado AS Estado, tareas.id as tarea_ID, tareas.fecha_finalizacion, tareas.resolucion as Resolucion FROM Cuadrillas INNER JOIN Tareas_Empleados ON Cuadrillas.id = Tareas_Empleados.id_cuadrilla INNER JOIN Tareas ON Tareas_Empleados.id_tarea = Tareas.id INNER JOIN Tipologias ON Tareas.id_tipologia = Tipologias.id INNER JOIN Estados ON Tareas.id_estado = Estados.id WHERE estado = 'Finalizada' GROUP BY tarea_ID";
$resultado= $conexion->prepare($Consulta);
$resultado->execute();
$dataFin=$resultado->fetchAll(PDO::FETCH_ASSOC);


?>

<!-- prueba de codigo para kanban -->


<div class="content-page" style="margin-left: 0px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="board">

                    <!-- COMIENZA PRIMER COLUMNA -->
                    <div class="tasks" data-plugin="dragula"
                        data-containers="[&quot;task-list-one&quot;, &quot;task-list-two&quot;, &quot;task-list-three&quot;, &quot;task-list-four&quot;]">
                        <h5 id="ColumPro" class="mt-0 task-header text-uppercase">Pendiente</h5>
                        <div id="task-list-one" class="task-list-items">



                            <!-- Tarea 1 -->
                            <?php
                                foreach($dataPen as $dat) {
                            ?>

                            <div class="card mb-0" draggable="true" title='Arrastre la tarea donde corresponda'>
                                <div class="card-body p-3">
                                    <i class="fa fa-bars"  style="font-size:22px;" aria-hidden="true"></i>
                                    <small class="float-end text-muted">Fecha Inicio: <?php echo $dat['FechaInicio'] ?></small>

                                    <br>

                                    <span style="background-color: rgb(232, 76, 61); color: white; font-size:15px;" class="badge "><?php echo $dat['Estado'] ?></span>
                                    <br>

                                    <label  class="col-form-label font-weight-bold">Tipología:</label>
                                    <label  class="col-form-label" ><?php echo $dat['Tipos'] ?></label>

                                     <br>
                                    <label  class="col-form-label font-weight-bold">Descripcion:</label>
                                    <p class="mb-0">
                                        <span class="card-text">
                                        <?php echo $dat['TareaDesc'] ?>
                                        </span>
                                    </p>
                                    
                                    
                                    <p class="mb-0">   
                                    <span class="align-middle" style="color:#26A2AE";>#</span>
                                        <span id="idtarea" class="align-middle" style="color:#26A2AE";><?php echo $dat['tarea_ID'] ?></span>
                                    </p>
                                </div>
                            </div>
                            <!-- Finaliza tarea 1 -->

                            <?php
                                }
                            ?>

                        </div>
                    </div>
                    <!-- FINALIZA PRIMER COLUMNA -->

                    <!-- COMIENZA SEGUNDA COLUMNA -->
                    <div class="tasks">
                        <h5 id="ColumPro" class="mt-0 task-header text-uppercase">En proceso</h5>


                        <div id="task-list-two" class="task-list-items">

                            <!-- Tarea 1 -->

                            <?php
                                foreach($dataPros as $dat) {
                            ?>

                            <div class="card mb-0" draggable="true" title='Arrastre la tarea donde corresponda'>
                                <div class="card-body p-3">
                                    <i class="fa fa-bars"  style="font-size:22px;" aria-hidden="true"></i>
                                    <small class="float-end text-muted" >Fecha Inicio: <?php echo $dat['FechaInicio'] ?></small>
                                    <br>
                                    
                                    <span style="background-color: rgb(255, 205, 2); color: white; font-size:15px;" class="badge"><?php echo $dat['Estado'] ?></span>
                                    <br>
                                    <label  class="col-form-label font-weight-bold">Tipología:</label>
                                    <label  class="col-form-label" ><?php echo $dat['Tipos'] ?></label>
                                    
                                    <br>
                                    <label  class="col-form-label font-weight-bold">Descripcion:</label>
                                    <p class="mb-0">
                                        <span class="card-text">
                                        <?php echo $dat['TareaDesc'] ?>
                                        </span>
                                    </p>
                                    
                                    <p class="mb-0">   
                                        <span class="align-middle" style="color:#26A2AE";>#</span>
                                        <span id="idtarea" class="align-middle" style="color:#26A2AE";><?php echo $dat['tarea_ID'] ?></span>
                                    </p>
                                </div>
                            </div>
                            <!-- Finaliza tarea 1 -->

                            <?php
                                }
                            ?>

                        </div>
                    </div>
                    <!-- FINALIZA SEGUNDA COLUMNA -->

                    <!-- COMIENZA TERCER COLUMNA -->
                    <div class="tasks" >
                        <h5 id="ColumPro" class="mt-0 task-header text-uppercase">Finalizado</h5>
                        <div id="task-list-three" class="task-list-items">

                        <!-- Tarea 1 -->
                        <?php
                                foreach($dataFin as $dat) {
                            ?>

                         <div class="card mb-0"  draggable="true" title='Puede deshacer la finalizacion arrastrando &#10;la tarea a otra columna.'>   <!--  quitar el daggable   draggable="true"-->
                                <div class="card-body p-3">
                                    <i class="fa fa-bars"  style="font-size:22px;" aria-hidden="true"></i>
                                    <small class="float-end text-muted">Fecha Inicio: <?php echo $dat['FechaInicio'] ?></small>
                                    <br>
                                    <small class="float-end text-muted">Fecha Finalizacion: <?php echo $dat['fecha_finalizacion'] ?></small>
                                    <span style="background-color: rgb(28, 200, 138); color: white; font-size:15px;" class="badge"><?php echo $dat['Estado'] ?></span>

                                    <label  class="col-form-label font-weight-bold">Tipología:</label>
                                    <label  class="col-form-label" ><?php echo $dat['Tipos'] ?></label>
                                    
                                    <br>
                                    <label  class="col-form-label font-weight-bold">Descripcion:</label>
                                    <p class="mb-0">
                                        <span class="card-text">
                                        <?php echo $dat['TareaDesc'] ?>
                                        </span>
                                    </p>
                                    
                                    <label  class="col-form-label font-weight-bold">Resolucion:</label>
                                    <p class="mb-0">
                                        <span class="card-text" placeholder="Sin Resolucion">
                                        <?php echo $dat['Resolucion'] ?>
                                        </span>
                                    </p>

                                    <p class="mb-0">   

                                        <span class="align-middle" style="color:#26A2AE";>#</span>
                                        <span id="idtarea" class="align-middle" style="color:#26A2AE";><?php echo $dat['tarea_ID'] ?></span>
                                    </p>
                                </div>
                            </div>
                            <!-- Finaliza tarea 1 -->

                            <?php
                                }
                            ?>

                        </div>
                    </div>
                    <!-- FINALIZA TERCER COLUMA -->

                </div> <!-- end .board-->
            </div> <!-- end col -->
        </div><!-- end row-->


        <!-- /.container-fluid -->
        <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close btnCancelar" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form">
                        <div class="modal-body">    
                                                 
                            <div class="row justify-content-md-center">
                                <div class="col-lg-8">
                                    <div class="input-group mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label for="" class="col-form-label">Resolucion de la tarea:</label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <textarea class="form-control" aria-label="With textarea" id="resTarea" style="min-height: 150px; height: 150px;" placeholder="No es obligatorio una resolucion!" maxlength="300"></textarea>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light btnCancelar" id="cancelar">Cancelar</button>
                                <button type="submit" id="btnGuardar" class="btn btn-dark">Enviar</button>
                            </div>                    
                    </form>    
            </div>
        </div>                        

    </div> <!-- content -->






<!-- finaliza prueba de codigo para kanban -->

<?php require_once "vistas/parte_inferior.php"?>