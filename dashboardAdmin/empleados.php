<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container text-center">
  <div class="row row-cols-2">
    <!-- Lista Empleados -->
    <div class="card col m-3">
      <div class="card-header">
        Empleados
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item list-group-item-action">Martinez Carlos</li>
        <li class="list-group-item list-group-item-action">Alvarez Pedro</li>
        <li class="list-group-item list-group-item-action">Perez Gabriela</li>
        <li class="list-group-item list-group-item-action">Puerta Alberto</li>
        <li class="list-group-item list-group-item-action">Gonzalez Juan</li>
        <li class="list-group-item list-group-item-action">Acosta Ezequiel</li>
        <li class="list-group-item list-group-item-action">Pamio Azul</li>
      </ul>
      <button type="button" class="btn btn-primary m-3">Agregar empleado</button>
    </div>
    
    <!-- Finaliza lista empleados -->

    <!-- Lista areas -->
    <div class="card col m-3">
      <div class="card-header">
        Areas
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item list-group-item-action">Cuadrilla 1</li>
        <li class="list-group-item list-group-item-action">Cuadrilla 2</li>
        <li class="list-group-item list-group-item-action">Cuadrilla 3</li>
        <li class="list-group-item list-group-item-action">Cuadrilla 4</li>
        <li class="list-group-item list-group-item-action">Cuadrilla 5</li>
        <li class="list-group-item list-group-item-action">Cuadrilla 6</li>
        <li class="list-group-item list-group-item-action">Cuadrilla 7</li>
      </ul>
      <button type="button" class="btn btn-primary row m-3">Agregar area</button>
    </div>
    
    <!-- Finaliza lista area -->
  </div>
</div>
<!--FIN del cont principal-->

<?php require_once "vistas/parte_inferior.php"?>