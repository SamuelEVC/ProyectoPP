<?php
session_start();
unset($_SESSION["s_usuario"]);
unset($_SESSION["s_idRol"]);
unset($_SESSION["s_rol_descripcion"]);
unset($_SESSION["s_idUsuario"]);
unset($_SESSION["s_nombre"]);
session_destroy();
header("Location: ../index.php");
?>