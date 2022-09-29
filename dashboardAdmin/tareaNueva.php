<?php require_once "vistas/parte_superior.php"?>

<?php
include_once '/bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();


$consulta = "SELECT descripcion FROM `tipologias`";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!--INICIO del cont principal-->
<div class="container-fluid">
  <div class="jumbotron jumbotron-fluid">
    <div class="row justify-content-md-center">
      <div class="col-lg-center">
        <div class="input-group mb-3">
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                Seleccione una Tipologia
                </button>
                <div class="dropdown-menu">
                    <?php                            
                       foreach($data as $dat) {                                                        
                        ?>
                        <a class="dropdown-item" ><?php echo $dat['descripcion'] ?></a>
                      <?php
                      }
                      ?>   
                </div>
              </div>
          </div>
      </div>
    </div>
    

    <div class="row justify-content-md-center">
      <div class="col-lg-8">
        <div class="input-group mb-3">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">Descripcion de la tarea</span>
            </div>
            <textarea class="form-control" aria-label="With textarea"></textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-md-center">
      <div class="col-lg-center">
        <div class="input-group mb-3">
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                    Seleccione una Cuadrilla
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </div>
          </div>
      </div>
    </div>

    <hr class="my-4"> 
    
    <div class="row ml-2">
      <div class="col-8">
      </div>

      <div class="mr-2">
        <div class="input-group">
          <button type="button" class="btn btn-primary">Confirmar</button>
        </div> 
      </div>

      <div class= "mr-2">
        <div class="input-group">
          <button type="button" class="btn btn-dark">Cancelar</button>
        </div> 
      </div>

    </div>  
  </div>
</div>




<?php require_once "vistas/parte_inferior.php"?>