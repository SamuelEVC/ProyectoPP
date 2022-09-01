<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <div class="jumbotron">
                        
        <h1 class="display-4 text-center">¡Bienvenido!</h1>
        <h2 class="text-center">Usuario: <span class="badge badge-primary"><?php echo $_SESSION["s_usuario"];?></span></h2>    
        <p class="lead text-center">Esta es la página de inicio, luego de un LOGIN correcto.</p>
        <h2 class="text-center">Su permiso es: <span class="badge badge-warning"><?php echo $_SESSION["s_rol_descripcion"];?></span></h2> 
        <hr class="my-4">          
         <a class="btn btn-danger btn-lg" href="../bd/logout.php" role="button">Cerrar Sesión</a>
      </div>
    </div>
  </div>
</div>



<!--FIN del cont principal-->

<?php require_once "vistas/parte_inferior.php"?>