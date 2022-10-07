<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->

<?php 
include_once '/bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT Tareas.id As tarea_ID, Tipologias.descripcion as Tipologia, Estados.estado AS Estado, Tareas.Descripcion , Cuadrillas.nombre Cuadrilla, Tareas.resolucion as Resolucion, Tareas.fecha_inicio as Fecha_Inicio, Tareas.fecha_finalizacion as Fecha_final FROM Cuadrillas INNER JOIN Tareas_Empleados ON Cuadrillas.id = Tareas_Empleados.id_cuadrilla INNER JOIN Tareas ON Tareas_Empleados.id_tarea = Tareas.id INNER JOIN Tipologias ON Tareas.id_tipologia = Tipologias.id INNER JOIN Estados ON Tareas.id_estado = Estados.id GROUP BY tarea_ID";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$dataAll=$resultado->fetchAll(PDO::FETCH_ASSOC);

$consultaTipo = "SELECT id, descripcion FROM `tipologias` ORDER BY descripcion ASC";//el truco para que salga en orden alfabetico
$resultadoTipo = $conexion->prepare($consultaTipo);
$resultadoTipo->execute();
$dataTipo=$resultadoTipo->fetchAll(PDO::FETCH_ASSOC);
 

$consultaCuad = "SELECT id, nombre FROM `cuadrillas` ORDER BY nombre ASC";
$resultadoCuad = $conexion->prepare($consultaCuad);
$resultadoCuad->execute();
$dataCuad=$resultadoCuad->fetchAll(PDO::FETCH_ASSOC);

$consultaCuad = "SELECT estado FROM `estados`";
$resultadoCuad = $conexion->prepare($consultaCuad);
$resultadoCuad->execute();
$dataEstado=$resultadoCuad->fetchAll(PDO::FETCH_ASSOC);
?>




<!-- Main Content -->
<div id="content">
    <div class="container-fluid">

            <!-- Row para los criterios de buscqueda -->
            <div class="card">
                <div class="card-header CritBusc">
                        <div class="row justify-content-end">
                            <div class="col-auto mr-auto">
                                <h4 class="card-title">Criterios de busqueda</h4>
                            </div>
                            <div class="col-auto">
                                
                                    <button type="button" class="btn btn-tool" data-toggle="collapse"  data-target="#collapseExample" aria-expanded="true" aria-controls="#collapseExample">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                
                            </div>

                        </div>
                        <!-- End Card Tools -->
                </div>
                <div class="card-body collapse show" id="collapseExample">
                    <div class="row">
                        <div class="col">
                            <select class="custom-select custom-select-sm" id="DropDownTipologia">
                                <option selected value="0">Seleccione una tipologia</option>
                                    <?php                            
                                        foreach($dataTipo as $datT) { 
                                    ?>
                                    <option value="<?php echo $datT['descripcion'] ?>" id="tipoloDropdata"> <?php echo $datT['descripcion'] ?></option>
                                    <?php
                                        }
                                    ?>   

                            </select>       
                        </div>
                        <div class="col">
                            <select class="custom-select custom-select-sm" id="DropDownCuadrilla">
                                <option selected value="0">Seleccione una cuadrilla</option>
                                    <?php                            
                                        foreach($dataCuad as $datT) { 
                                    ?>
                                    <option value="<?php echo $datT['nombre'] ?>" id="tipoloDropdata"> <?php echo $datT['nombre'] ?></option>
                                    <?php
                                        }
                                    ?>   

                            </select> 
                        </div>       
                        <div class="col">        
                            <tbody><tr>
                                <!--<td>Minimum date:</td> -->
                                <td><input type="text" id="min" name="min" placeholder="Fecha desde..."class="form-control"> </td>
                                </tr> 
                            </tbody>
                        </div> 
                        <div class="col">                
                            <tbody><tr>
                                <!--<td>Maximum date:</td> -->
                                <td><input type="text" id="max" name="max" placeholder="Fecha hasta..." class="form-control"></td>
                                </tr> 
                            </tbody>  
                        </div>                
                        <div class="col">
                            <select class="custom-select custom-select-sm" id="DropDownEstado">
                                <option selected value="0">Seleccione un estado</option>
                                    <?php                            
                                        foreach($dataEstado as $datT) { 
                                    ?>
                                    <option value="<?php echo $datT['estado'] ?>" id="tipoloDropdata"> <?php echo $datT['estado'] ?></option>
                                    <?php
                                        }
                                    ?>   

                            </select>      
                        </div>
                        <div class="d-flex justify-content-center">                
                            <button class='btn btn-warning' title="limpiar filtros" id="btnLimpiarBusqueda"><i class="fa fa-eraser" aria-hidden="true" ></i></button>
                        </div>   
                    </div>
                </div>
            </div>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary"><center>Infome General</center></h3>
                </div>
                <div class="card-body">
                    <div class="container">
                            <div class="row mt-2">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">        
                                            <table id="tablaInformeGeneral" class="table table-striped table-bordered table-condensed" style="width:100%">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th style="display:none">Tarea_ID</th>
                                                        <th>Tipologia</th>
                                                        <th>Cuadrilla</th>
                                                        <th>Descripcion</th>
                                                        <th>Resolucion</th>
                                                        <th>Fecha inicio</th>
                                                        <th>Fecha Final</th>
                                                        <th>Estado</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php       
                                                    foreach($dataAll as $dat) {                                                        
                                                    ?>
                                                    <tr>
                                                        <td style="display:none"><?php echo $dat['tarea_ID'] ?></td>
                                                        <td><?php echo $dat['Tipologia'] ?></td>
                                                        <td><?php echo $dat['Cuadrilla'] ?></td>
                                                        <td><?php echo $dat['Descripcion'] ?></td>
                                                        <td><?php echo $dat['Resolucion'] ?></td>
                                                        <td><?php echo $dat['Fecha_Inicio'] ?></td>
                                                        <td><?php echo $dat['Fecha_final'] ?></td>
                                                        <td><?php echo $dat['Estado'] ?></td>
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
        <!--Modal para CRUD-->
        <div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <form id="formTarea">    
                    <div class="modal-body">
                        <div class="form-group">
                            <label  class="col-form-label font-weight-bold">Tipologia:</label>
                            <label  class="col-form-label" id="tipologia">...</label>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-form-label font-weight-bold">Estado:</label>
                            
                            <label style="font-size:25px;"><span class="badge "  id="estado">...</span></label>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-form-label font-weight-bold">Cuadrilla:</label>
                            <label  class="col-form-label" id="cuadrilla">...</label>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-form-label font-weight-bold">Empleados de la cuadrilla:</label>
                                <ul id="list">               
                                </ul>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-form-label font-weight-bold">Descripcion:</label>
                            <label  class="col-form-label" id="descripcion">...</label>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-form-label font-weight-bold">Resolucion:</label>
                            <label  class="col-form-label" id="resolucion">...</label>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-form-label font-weight-bold">Fecha Inicio:</label>
                            <label  class="col-form-label" id="FechaIni">...</label>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-form-label font-weight-bold">Fecha Final:</label>
                            <label  class="col-form-label" id="FechaFin">...</label>
                        </div>
                       
                        <div class="form-group">
                            <label  class="col-form-label font-weight-bold">Area:</label>
                            <label  class="col-form-label" id="area">...</label>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-form-label font-weight-bold">Jefe:</label>
                            <label  class="col-form-label" id="jefe">...</label>
                        </div>
                                                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>    
                </div>
            </div>
    </div>  
       
</div>

<!-- End of Main Content -->

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>