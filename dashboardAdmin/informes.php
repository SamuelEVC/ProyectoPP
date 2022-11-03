<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->

<?php 
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT tareas.id As tarea_ID, tipologias.descripcion as Tipologia, estados.estado AS Estado, tareas.Descripcion , cuadrillas.nombre as Cuadrilla, tareas.resolucion as Resolucion, tareas.fecha_inicio as Fecha_Inicio, tareas.Fecha_Finalizacion as Fecha_Final FROM cuadrillas INNER JOIN tareas_empleados ON cuadrillas.id = tareas_empleados.id_cuadrilla INNER JOIN tareas ON tareas_empleados.id_tarea = tareas.id INNER JOIN tipologias ON tareas.id_tipologia = tipologias.id INNER JOIN estados ON tareas.id_estado = estados.id GROUP BY Tarea_ID ORDER BY Tarea_ID";
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
                                <h4 class="card-title">Criterios de búsqueda</h4>
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
                                <option selected value="0">Seleccione una tipología</option>
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
                            <button class='btn btn-primary' title="limpiar filtros" id="btnLimpiarBusqueda"><i class="fa fa-eraser" aria-hidden="true" ></i></button>
                        </div>   
                    </div>
                </div>
            </div>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h3 class="m-0 font-weight-bold text-primary"><center>Informe General</center></h3>
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
                                                        <th>Tipología</th>
                                                        <th>Cuadrilla</th>
                                                        <th>Descripción</th>
                                                        <th>Resolución</th>
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
                                                        <td><?php echo $dat['Fecha_Final'] ?></td>
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
                    <div class="modal-body clipboard">
                        <div class="form-group">
                            <label  class="col-form-label font-weight-bold">Tipología:</label>
                            <label  class="col-form-label" id="tipologia">...</label>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-form-label font-weight-bold">Estado:</label>
                            
                            <label style="font-size:25px;"><span class="badge"  id="estado">...</span></label>
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
                            <label  class="col-form-label font-weight-bold">Descripción:</label>
                            <label  class="col-form-label" id="descripcion">...</label>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-form-label font-weight-bold">Resolución:</label>
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
                            <label  class="col-form-label font-weight-bold">Área:</label>
                            <label  class="col-form-label" id="area">...</label>
                        </div>
                        
                        <div class="form-group">
                            <label  class="col-form-label font-weight-bold">Jefe:</label>
                            <label  class="col-form-label" id="jefe">...</label>
                        </div>
                                                        
                    </div>
                    <div class="modal-footer">
                        <label  class="col-form-label" id="confCopy"></label>
                        <button type="button" class="btn btn-primary btnCopiador d-flex " title="Copiar al Portapapeles">
                            <span class="material-icons">content_copy</span>
                        </button>

                        
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>

                    </div>
                </form>    
                </div>
            </div>
    </div>  
       
</div>

<!-- End of Main Content -->

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>