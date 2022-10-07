<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->

<?php
include_once '/bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


//$consultaTareDia = "SELECT Tipologias.descripcion AS Tipos, Cuadrillas.nombre AS Cuadrilla, Tareas.descripcion AS TareaDesc, Tareas.fecha_inicio AS FechaInicio, Estados.estado AS Estado FROM Cuadrillas INNER JOIN Tareas_Empleados ON Cuadrillas.id = Tareas_Empleados.id_cuadrilla INNER JOIN Tareas ON Tareas_Empleados.id_tarea = Tareas.id INNER JOIN Tipologias ON Tareas.id_tipologia = Tipologias.id INNER JOIN Estados ON Tareas.id_estado = Estados.id";
//$consultaTareDia = "SELECT Tipologias.id AS tipologia_ID, Tipologias.descripcion AS tipologia, Cuadrillas.id AS cuadrilla_ID, Cuadrillas.nombre AS cuadrilla, Estados.id AS estado_id, Estados.estado, Tareas.descripcion, Tareas.fecha_inicio AS fecha_Ini FROM Cuadrillas INNER JOIN Tareas_Empleados ON Cuadrillas.id = Tareas_Empleados.id_cuadrilla INNER JOIN Tareas ON Tareas_Empleados.id_tarea = Tareas.id INNER JOIN Tipologias ON Tareas.id_tipologia = Tipologias.id INNER JOIN Estados ON Tareas.id_estado = Estados.id";
$consultaTareDia = "SELECT  Tareas.id AS tarea_ID, Tipologias.id AS tipologia_ID, Tipologias.descripcion AS tipologia, Cuadrillas.id AS cuadrilla_ID, Cuadrillas.nombre AS cuadrilla, Estados.id AS estado_ID, Estados.estado, Tareas.descripcion, Tareas.fecha_inicio AS fecha_Ini FROM Cuadrillas INNER JOIN Tareas_Empleados ON Cuadrillas.id = Tareas_Empleados.id_cuadrilla INNER JOIN Tareas ON Tareas_Empleados.id_tarea = Tareas.id INNER JOIN Tipologias ON Tareas.id_tipologia = Tipologias.id INNER JOIN Estados ON Tareas.id_estado = Estados.id GROUP BY tarea_ID";
$resultadoTareDia = $conexion->prepare($consultaTareDia);
$resultadoTareDia->execute();
$dataTareDia=$resultadoTareDia->fetchAll(PDO::FETCH_ASSOC);


$consultaTipo = "SELECT id, descripcion FROM `tipologias` ORDER BY descripcion ASC";//el truco para que salga en orden alfabetico
$resultadoTipo = $conexion->prepare($consultaTipo);
$resultadoTipo->execute();
$dataTipo=$resultadoTipo->fetchAll(PDO::FETCH_ASSOC);
 

$consultaCuad = "SELECT id, nombre FROM `cuadrillas` ORDER BY nombre ASC";
$resultadoCuad = $conexion->prepare($consultaCuad);
$resultadoCuad->execute();
$dataCuad=$resultadoCuad->fetchAll(PDO::FETCH_ASSOC);


?>

<!-- Main Content -->
<div id="content">
        <!-- Begin Page Content -->
        <div class="container-fluid">

        <div class="container">
        <div class="row">
    
        </div>    
    </div>    
    <br>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary"><center>Tareas Diarias</center></h3>
                </div>
                <div class="card-body">
                    <div class="container">
                            <div class="row mt-2">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">        
                                            <table id="tablaTareasDiarias" class="table table-striped table-bordered table-condensed" style="width:100%">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th style="display:none">Tarea_ID</th>
                                                        <th style="display:none">Tipologia_ID</th>
                                                        <th>Tipologia</th>
                                                        <th style="display:none">Cuadrilla_ID</th>
                                                        <th>Cuadrilla</th>
                                                        <th>Descripcion</th>
                                                        <th>Fecha inicio</th>
                                                        <th style="display:none">Estado_ID</th>
                                                        <th>Estado</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php                            
                                                    foreach($dataTareDia as $dat1) {                                                        
                                                    ?>
                                                    <tr>
                                                        <td style="display:none"><?php echo $dat1['tarea_ID'] ?></td>
                                                        <td style="display:none"><?php echo $dat1['tipologia_ID'] ?></td>
                                                        <td><?php echo $dat1['tipologia'] ?></td>
                                                        <td style="display:none"><?php echo $dat1['cuadrilla_ID'] ?></td>
                                                        <td><?php echo $dat1['cuadrilla'] ?></td>
                                                        <td><?php echo $dat1['descripcion'] ?></td>
                                                        <td><?php echo $dat1['fecha_Ini'] ?></td>                                                           
                                                        <td style="display:none"><?php echo $dat1['estado_ID'] ?></td>                                                            
                                                        <td id="estadoT"><?php echo $dat1['estado'] ?></td>                                                            
                                                        <td></td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    ?>                                
                                                </tbody>        
                                           </table>                    
                                        </div>
                                    </div>
                            </div>  
                        </div>  
                    
                    
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
        <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formTareas">
                        <div class="modal-body">    
                        
                            <div class="row justify-content-md-center">
                                <div class="col-md-center">
                                    <div class="input-group mb-3">
                                        <select class="custom-select custom-select-sm" id="tipoloDrop">
                                        <option selected >Seleccione una tipologia</option>
                                            <?php                            
                                                foreach($dataTipo as $datT) { 
                                            ?>
                                            <option value="<?php echo $datT['id'] ?>"> <?php echo $datT['descripcion'] ?></option>
                                            <?php
                                                }
                                            ?>   

                                        </select>   
                                    </div>
                                </div>
                            </div>

                                                 
                            <div class="row justify-content-md-center">
                                <div class="col-lg-8">
                                    <div class="input-group mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label for="" class="col-form-label">Descripcion de la tarea:</label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <textarea class="form-control" aria-label="With textarea" id="descTarea" style="min-height: 150px; height: 150px;" maxlength="300"></textarea>
                                        </div>
                                        
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-md-center">
                                <div class="col-lg-center">
                                    <div class="input-group mb-3">
                                        <select class="custom-select custom-select-sm" id="cuadrillaDrop">
                                        <option selected>Seleccione una cuadrilla</option>
                                        <?php                            
                                            foreach($dataCuad as $dat) {                                                           
                                            ?>
                                            <option value="<?php echo $dat['id']?>"> <?php echo $dat['nombre'] ?></option>                                            
                                            <?php
                                            }
                                            ?>   
                                        </select>   
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-dismiss="modal" id="cancelar">Cancelar</button>
                                <button type="submit" id="btnGuardar" class="btn btn-dark">Enviar</button>
                            </div>                    
                    </form>    
            </div>
        </div>
    </div>  
</div>
<!-- End of Main Content -->

</div>
<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>