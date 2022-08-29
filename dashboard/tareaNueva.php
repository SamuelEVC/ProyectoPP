<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container-fluid">
  <div class="card shadow mb-4">
  <div class="container">
  <h1><center>Agregar Nueva Tarea</center></h1>
  <div class="input-group mb-3">
    <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
      Tipologia
    </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <a class="dropdown-item" href="#">Something else here</a>
      </div>
    </div>
  </div>

  <div class="input-group mb-3">
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text" >Descripcion de la tarea</span>
      </div>
      <textarea class="form-control" aria-label="With textarea"></textarea>
    </div>
  </div>
  
  <div class="input-group mb-3">
    <div class="dropdown">
      <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
        Cuadrilla
      </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </div>
    </div>
    <div class="input-group mb-3">
        <button type="button" class="btn btn-primary">Confirmar</button>
        <button type="button" class="btn btn-dark"><a class="nav-link" href="informes.php">Cancelar</button>
      </div>
  </div>
  
<!--FIN del cont principal-->
  </div>
</div>



<?php require_once "vistas/parte_inferior.php"?>