<?php require_once "vistas/parte_superior.php"?>

<head>
  <link rel="stylesheet" href="styleEmpleados.css" />
</head>


<!--INICIO del cont principal-->
<div class="container-fluid">
  <div class="card shadow mb-4">
 <!-- modal -->
 <div class="modal" id="todo_form">
      <div class="header">
        <div class="title">Add Todo</div>
        <button class="btn close-modal">&times;</button>
      </div>
      <div class="body">
        <input type="text" id="todo_input" />
        <input type="submit" value="Add Todo" id="todo_submit" />
      </div>
    </div>
    <!-- todo -->
    <div class="todo-container">

      <div class="status" id="no_status">

        <h1>To Do</h1>

        <button id="add_btn" data-target-modal="#todo_form">+ Add Todo</button>

        <div class="todo" draggable="true">
          Hacer Tarea de Reparacion
          <span class="close">&times;</span>
        </div>
        
        <div class="todo" draggable="true">
          Llevar moden nuevo
          <span class="close">&times;</span>
        </div>

      </div>

      <div class="status">
        <h1>Pendiente</h1>
      </div>

      <div class="status">
        <h1>En Proceso</h1>
      </div>

      <div class="status">
        <h1>Finalizado</h1>
      </div>
    </div>

    <div id="overlay"></div>
  </div>
</div>

<script src="scriptsEmpleado"></script>
<!--FIN del cont principal-->

<?php require_once "vistas/parte_inferior.php"?>