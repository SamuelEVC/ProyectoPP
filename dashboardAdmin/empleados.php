<?php require_once "vistas/parte_superior.php"?>
<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$areaSessionID = $_SESSION["s_idArea"];

//Obtine los empleados en orden alfebetico
$consulta = "SELECT usuarios.id, usuarios.nombre FROM empleados 
INNER JOIN usuarios ON empleados.id_usuario = usuarios.id 
INNER JOIN cuadrillas ON empleados.id_cuadrilla = cuadrillas.id
INNER JOIN areas ON cuadrillas.id_area = areas.id 
where areas.id = $areaSessionID
ORDER BY nombre ASC ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$dataEmpleados=$resultado->fetchAll(PDO::FETCH_ASSOC);
//sort($dataEmpleados);   


$consulta = "SELECT `cuadrillas`.`id` as idCuadrilla, `cuadrillas`.`nombre`
FROM `cuadrillas`
INNER JOIN areas ON cuadrillas.id_area = areas.id 
where areas.id = $areaSessionID";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$dataCuadrillas=$resultado->fetchAll(PDO::FETCH_ASSOC);

?>
<!--INICIO del cont principal-->
<div class="container text-center">
  <div class="row row-cols-2">
    <!-- Lista Empleados -->
    <div class="card shadow col m-3">
      <div class="card-header">
        Empleados
      </div>
      <ul class="list-group list-group-flush">   
        <?php                            
        foreach($dataEmpleados as $dat) { 
          ?>
          <li class="list-group-item list-group-item-action ">
            <?php echo $dat['nombre'] ?>
            

              
            <div class='btn-group' id='btnAbsolutes'>
              
              <button value="<?php echo $dat['id']?>" class='btn btn-primary btn-sm' style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .25rem;" id= "btnEditarEmpleado" title='Editar Empleado'>
              
                <i class='material-icons' style="font-size: 1rem;">edit</i>
          
              </button>
            </div>
          
          </li>

        <?php
        }
        ?>   
      </ul>
      <button id="btnNuevoEmpleado" type="button" class="btn btn-primary m-3" data-toggle="modal">Agregar empleado</button>
    </div>
    
    <!-- Finaliza lista empleados -->

    <!-- Lista Cuadrillas -->
    <div class="card shadow col m-3">
      <div class="card-header">
        Cuadrillas
      </div>
      <ul class="list-group list-group-flush">
      <?php                            
        foreach($dataCuadrillas as $dat) { 
          ?>
          
          <li  class="list-group-item list-group-item-action row" id="cuadrillaList"> <?php echo $dat['nombre']?>
          <div class='btn-group' id='btnAbsolutes'>
                <!-- NOTA:Le asigne el id al boton para poder acceder a el mas facilmente -->
              <button value="<?php echo $dat['idCuadrilla']?>" class='btn btn-primary btn-sm' style="--bs-btn-padding-y: .10rem; --bs-btn-padding-x: .25rem; --bs-btn-font-size: .25rem;" id="btnEditarCuadrilla"  title='Editar Cuadrilla'>
                <i id="textButton" class='material-icons' style="font-size: 1rem;">edit</i>          
              </button>
            </div>
        </li>
        <?php
        }
        ?>         
      </ul>
      <button id="btnNuevaCuadrilla" type="button" class="btn btn-primary row m-3">Agregar Cuadrilla</button>
    </div>
    
    <!-- Finaliza lista area -->
  </div>

      <!--Modal para EMPLEADOS-->
      <div class="modal fade" id="modalEMP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form id="formEmpleados">    
                <div class="modal-body">
                    <div class="form-group">
                    <label for="" class="col-form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombreUser">
                    </div>
                    <div class="form-group userDiv">
                    <label for="" class="col-form-label">Usuario:</label>
                    <input type="text" class="form-control" id="usuario">
                    </div>                
                    <div class="form-group">
                    <label for="" class="col-form-label">Contraseña Inicial:</label>
                    <input type="text" class="form-control" id="contraseña">
                    </div>

                    <div class="form-group">
                      <select class="custom-select custom-select-sm" id="cuadrillaSELECT">
                        <option  selected value="0">Seleccione una cuadrilla</option>
                          <?php                            
                            foreach($dataCuadrillas as $dat) {                                                           
                            ?>
                            <option value="<?php echo $dat['idCuadrilla']?>"> <?php echo $dat['nombre']?> </option>                                            
                            <?php
                            }
                            ?>   
                      </select>
                    </div>

                    <div class="form-group" id="check">
                    <input type="checkbox"  id="chkhabilitado">  Habilitado</imput>
                    </div>

                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit"  class="btn btn-dark">Guardar</button>
                </div>
            </form>    
            </div>
        </div>
    </div>
    
    <!-- modal para CUADRILLAS -->
    <div class="modal fade" id="modalCUAD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <form id="formCuadrilla"> 

                <div class="modal-body">
                    <div class="form-group">
                    <label for="nombre" class="col-form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombreCuadrilla">
                    </div>

                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit"  class="btn btn-dark">Guardar</button>
                </div>
            </form>    
            </div>
        </div>
    </div>  
</div>
<!--FIN del cont principal-->

<?php require_once "vistas/parte_inferior.php"?>